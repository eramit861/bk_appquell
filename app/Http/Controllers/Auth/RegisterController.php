<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeAboardAttorney;
use App\Mail\WelcomeAboardAttorneyAdditionalMail;
use App\Mail\welcomeAboardAttorneyAdminNotify;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo();
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
            'company_name' => 'required|alpha_dash_space',
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:50'],
            'state_bar' => ['required', 'string', 'max:17'],
            'attorney_address' => ['string', 'max:150'],
            // 'attorney_address2' => ['string', 'max:150'],
            'attorney_city' => ['required', 'string', 'max:50'],
            'attorney_state' => ['required', 'string', 'max:2'],
            'attorney_zip' => ['required', 'string', 'max:5'],
            'attorney_phone' => ['required', 'string', 'max:12'],
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ],
            [
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'company' => $data['company_name'],
            'role' => User::ATTORNEY,
            'password' => Hash::make($data['password'])
        ]);
        $companyData = [
            'attorney_id' => $user->id,
            'company_name' => $data['company_name'],
            'state_bar' => $data['state_bar'],
            'attorney_address' => $data['attorney_address'] ?? '',
            'attorney_address2' => $data['attorney_address2'] ?? '',
            'attorney_city' => $data['attorney_city'],
            'attorney_state' => $data['attorney_state'],
            'attorney_zip' => $data['attorney_zip'],
            'attorney_phone' => $data['attorney_phone'],
            'attorney_fax' => $data['attorney_fax']
        ];
        \App\Models\AttorneyCompany::create($companyData);

        $dataToSave = [
            'attorney_id' => $user->id,
            'is_associate' => 0,
            'bank_statement_months' => 6,
            'tax_return_day_month' => '01/10',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        \App\Models\AttorneySettings::updateOrCreate(['attorney_id' => $user->id], $dataToSave);

        $mailData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        $mailDataAttorney = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['attorney_phone'],
            'company_name' => $data['company_name'],
        ];

        try {
            Mail::to($data['email'])->send(new WelcomeAboardAttorney($mailData));
            Mail::to($data['email'])->send(new WelcomeAboardAttorneyAdditionalMail($data['name']));
            Mail::to('mcroak@bkassistant.net')->send(new welcomeAboardAttorneyAdminNotify($mailDataAttorney));
        } catch (\Exception $e) {

        }

        return $user;
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        $package_id = "";
        $package = request()->package_id;

        $packageArr = ["", "standard","basic_plus", "premium","premiumplus", "black_label", "payroll_assistant","ultimate", "ultimateplus"];
        if (!in_array($package, $packageArr)) {
            return abort(404) ;
        }

        if (isset($package)) {
            switch ($package) {
                case 'standard': $package_id = \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION;
                    break;
                case 'basic_plus': $package_id = \App\Models\AttorneySubscription::BASIC_PLUS_SUBSCRIPTION;
                    break;
                case 'premium': $package_id = \App\Models\AttorneySubscription::PREMIUM_SUBSCRIPTION;
                    break;
                case 'black_label': $package_id = \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION;
                    break;
                case 'payroll_assistant': $package_id = \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION;
                    break;
                case 'premiumplus': $package_id = \App\Models\AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION;
                    break;
                case 'ultimateplus': $package_id = \App\Models\AttorneySubscription::ULTIMATE_PLUS_SUBSCRIPTION;
                    break;
                case 'ultimate': $package_id = \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION;
                    break;
                    break;
            }
        }

        if (Auth::check() && auth()->user()->role == User::CLIENT) {
            return '/client/dashboard';
        } elseif (Auth::check() && auth()->user()->role == User::ATTORNEY) {
            return route('attorney_dashboard', ['package_id' => $package_id]);
        } else {
            return '/login';
        }


    }
}
