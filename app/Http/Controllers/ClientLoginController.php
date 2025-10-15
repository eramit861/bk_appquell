<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuthHelper;

class ClientLoginController extends Controller
{

    /**
     * Show the client login page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $slug = \Route::current()->parameter('attorney');
        $logoUrl = $this->getAttorneyLogoUrl($slug);

        return view('client.login', [
            'client' => true,
            'logourl' => $logoUrl
        ]);
    }

    /**
     * Get attorney logo URL from slug
     */
    protected function getAttorneyLogoUrl(?string $slug): string
    {
        if (empty(trim($slug))) {
            return '';
        }

        $attorneyId = $this->getAttorneyIdFromSlug($slug);
        
        if (!$attorneyId) {
            return '';
        }

        return $this->getCompanyLogoUrl($attorneyId);
    }

    /**
     * Get attorney ID from custom login slug
     */
    protected function getAttorneyIdFromSlug(string $slug): ?int
    {
        return \App\Models\AttorneySettings::where('custom_login_slug', $slug)
            ->value('attorney_id');
    }

    /**
     * Get company logo URL for attorney
     */
    protected function getCompanyLogoUrl(int $attorneyId): string
    {
        $company = \App\Models\AttorneyCompany::where('attorney_id', $attorneyId)
            ->select('company_logo')
            ->first();

        if (!$company || empty($company->company_logo)) {
            return '';
        }

        $logoPath = public_path($company->company_logo);
        
        if (!file_exists($logoPath)) {
            return '';
        }

        return url($company->company_logo);
    }
    /**
     * Handle client login
     */
    public function index(Request $request)
    {
        $this->sanitizeInput($request);
        $this->validateLoginInput($request);
        
        $credentials = $request->only('email', 'password');
        Session::flush();
        
        // Verify client exists
        if (!$this->clientExists($credentials['email'])) {
            return redirect()->route('client_login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
        
        // Attempt authentication
        if (!$this->attemptClientLogin($credentials)) {
            return redirect()->route('client_login')
                ->with('error', 'Password is Incorrect.');
        }
        
        // Verify attorney association
        $attorneyCheck = $this->verifyClientAttorney();
        if ($attorneyCheck !== true) {
            return $attorneyCheck;
        }
        
        // Redirect based on login history
        return $this->redirectAfterSuccessfulLogin();
    }

    /**
     * Sanitize email and password input
     */
    protected function sanitizeInput(Request $request)
    {
        $request->merge([
            'email' => trim($request->email),
            'password' => trim($request->password),
        ]);
    }

    /**
     * Validate login credentials
     */
    protected function validateLoginInput(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    /**
     * Check if client exists with given email
     */
    protected function clientExists(string $email): bool
    {
        return User::where(['email' => $email, 'role' => User::CLIENT])->exists();
    }

    /**
     * Attempt to authenticate client with credentials
     */
    protected function attemptClientLogin(array $credentials): bool
    {
        $loginSuccessful = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => User::CLIENT
        ]);

        if ($loginSuccessful) {
            AuthHelper::attemptLogin(request());
        }

        return $loginSuccessful;
    }

    /**
     * Verify that client has a valid attorney association
     * 
     * @return true|\Illuminate\Http\RedirectResponse
     */
    protected function verifyClientAttorney()
    {
        $attorney = \App\Models\ClientsAttorney::where('client_id', auth()->user()->id)->first();
        
        if (!isset($attorney->attorney_id) || empty($attorney)) {
            Auth::logout();
            return redirect()->route('client_login')
                ->with('error', "Your attorney's account is no more with us, please contact your attorney.");
        }

        return true;
    }

    /**
     * Redirect user after successful login based on their login history
     */
    protected function redirectAfterSuccessfulLogin()
    {
        $user = auth()->user();

        // First-time login
        if ($user->logged_in_ever == 0) {
            session(['userJustLogin' => true]);
            $route = $this->getFirstTimeLoginRoute();
            return redirect()->route($route)->with('success', 'You are logged in.');
        }

        // Returning user
        return redirect()->route('client_dashboard')->with('success', 'You are logged in.');
    }

    /**
     * Determine the appropriate route for first-time login
     */
    protected function getFirstTimeLoginRoute(): string
    {
        $user = Auth::user();
        
        return ($user->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
            ? 'client_payroll_landing'
            : 'client_landing';
    }
}



