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
             * Check if the user is already logged-in or not based on that it will fetch data from the database
             * if user is not registered then it will create the new user and login the user
             */
            $is_user = User::where('email', $user->getEmail())->first();
            if (!$is_user) {
                User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getId() . ''),
                    'google_id' => $user->getId(),
                ]);
                /**
                 * Redirect to Registration Process
                 */
                $redirectUrl = route('GoogleOTP', [
                    'email' => $user->getEmail(),
                    'name' => $user->getName()
                ]);
                return redirect($redirectUrl);
            } else {
                /**
                 * If the user is already regitered then it will fetch the data from the database based on the google
                 * then login the user 
                 */
                $useremail = $user->getEmail();
                $verify = User::where('email', $useremail)->first();
                /**
                 * If user is already logged-in but not verified then it will redirect to the OtP Varification page 
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
