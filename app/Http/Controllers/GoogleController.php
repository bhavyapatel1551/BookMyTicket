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
    public function loginwithgoogle()
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        try {

            $user = Socialite::driver('google')->user();
            $is_user = User::where('email', $user->getEmail())->first();

            // dd($user->getName());

            if (!$is_user) {
                $saveUser = User::create(

                    [
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'password' => Hash::make($user->getName() . '@1'), ////.$user->getId())
                        'google_id' => $user->getId(),
                    ]
                );

                $redirectUrl = route('showOtpFormGoogle', [
                    'email' => $user->getEmail(),
                    'name' => $user->getName()
                ]);

                return redirect($redirectUrl);
            } else {
                $saveUser = User::where('email', $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $useremail = $user->getEmail();
                $verify = User::where('email', $useremail)->first();
                if ($verify->email_verified_at ===  null) {
                    Log::info('Verify');
                    $redirectUrl = route('showOtpFormGoogle', [
                        'email' => $user->email,
                        'name' => $user->name,
                    ]);

                    return redirect($redirectUrl);
                } else {
                    Log::info('Login');
                    $saveUser = User::where('email', $user->getEmail())->first();
                    // if(Auth::attempt(['email' => $user->getEmail(), 'password' => $user->getName().'@'.$user->getId()])){
                    Auth::loginUsingId($saveUser->id);
                    return redirect()->route('dashboard');
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
