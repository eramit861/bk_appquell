<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        //$this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $request->validate([
          'email' => 'required|string',
          'password' => 'required|string',
      ]);
        Session::flush();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,  'role' => User::ATTORNEY])) {
            AuthHelper::attemptLogin($request);

            return redirect()->route('attorney_dashboard')->with('success', 'You are successfully logged in.');

        } else {
            return redirect()->back()->with('error', 'You have entered an invalid email or password.');
        }
    }




    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        if (Auth::check() && auth()->user()->role == User::CLIENT) {
            return '/client/dashboard';
        } elseif (Auth::check() && auth()->user()->role == User::ATTORNEY) {
            return '/attorney/dashboard';
        } else {
            return '/login';
        }
    }



}
