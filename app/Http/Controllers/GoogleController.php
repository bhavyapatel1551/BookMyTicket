<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class GoogleController extends Controller
{
    /**
     * Redirect to Google sign-in link
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function loginwithgoogle()
    {
        /**
         * Check if the user is logged-in or not 
         */
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return Socialite::driver('google')->redirect();
    }

    /**
     * Based on the email id it will check if the user is already registered or not
     * If not registered then it will create a new user
     * If registered then it will redirect to home page
     * @return mixed|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callbackFromGoogle()
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        try {

            $user = Socialite::driver('google')->user();
            /**
             * Check if user is already logged-in or not
             * if not then create new user into database
             */
            $is_user = User::where('email', $user->getEmail())->first();
            if (!$is_user) {
                User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getId() . ''),
                    'google_id' => $user->getId(),
                ]);
                // Redirect to Registartion Fees proccess
                /**
                 * Redirect to Registration Fees Process
                 */
                $redirectUrl = route('GoogleOTP', [
                    'email' => $user->getEmail(),
                    'name' => $user->getName()
                ]);
                return redirect($redirectUrl);
            } else {
                /**
                 * If user is already Registered then it will get data from the database and login user
                 */
                $useremail = $user->getEmail();
                $verify = User::where('email', $useremail)->first();
                /**
                 * If user's email is not verifed then it will sent the otp
                 */
                if ($verify->email_verified_at ===  null) {
                    $redirectUrl = route('showOtpFormGoogle', [
                        'email' => $user->email,
                        'name' => $user->name,
                    ]);

                    return redirect($redirectUrl);
                } else {
                    $saveUser = User::where('email', $user->getEmail())->first();
                    Auth::loginUsingId($saveUser->id);
                    return redirect()->route('dashboard');
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
