<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{

    /* Redirect to a user specified provider.
   */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /* Stores user data returned by the user selected provider.
   */
    public function callback($provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        //Verify if the user is just registered.
        $user = User::where([
            'provider' => $provider,
            'provider_id' => $providerUser->id,
        ])->orWhere('email', $providerUser->email)->first();


        //If the user arent registered store his data.
        if (!$user) {
            $user = User::create(
                [
                    'name' => $providerUser->name,
                    'email' => $providerUser->email,
                    'surname' => $provider === 'google' ? $providerUser->user['given_name'] : $providerUser->name,
                    'nickname' => $provider === 'google' ? $providerUser->user['family_name'] : $providerUser->email,
                    'password' => Hash::make(Str::random(10)),
                    'role_id' => 4,
                    'provider' => $provider,
                    'provider_id' => $providerUser->id,
                    'provider_token' => $providerUser->token,
                ]
            );
        }

        Auth::login($user);

        return redirect()->route('account');
    }
}
