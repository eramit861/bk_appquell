<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );



        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }
    /**
         * Where to redirect users after resetting their password.
         *
         * @var string
         */

    protected $redirectTo = RouteServiceProvider::HOME;
    /**
    * Reset the given user's password.
    *
    * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
    * @param  string  $password
    * @return void
    */
    protected function resetPassword($user, $password)
    {

        $this->setUserPassword($user, $password);
        $user->setRememberToken(Str::random(60));

        $user->save();
        Auth::login($user);
        event(new PasswordReset($user));

        if ($user->role == User::ATTORNEY) {
            $this->redirectTo = route('attorney_dashboard');
        }

        if ($user->role == User::CLIENT) {
            if ($user->logged_in_ever == 0) {
                session(['userJustLogin' => true]);
                $route = ($user->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                    ? 'client_payroll_landing'
                    : 'client_landing';
            } else {
                $route = 'client_dashboard';
            }
            $this->redirectTo = route($route);
        }
        //$this->guard()->login($user);
        session()->flash('success', 'Your password has been reset successfully!');
    }

    /**
     * Set the user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->recommned_password_update = 0;
    }




}
