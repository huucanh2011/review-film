<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\AbstractUser;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();

        $user = $this->findOrCreate($providerUser, $provider);

        auth()->login($user);

        return redirect()->home();
    }

    private function findOrCreate(AbstractUser $providerUser, $provider)
    {
        $user = User::where('provider_id', $providerUser->getId())
            ->orWhere('email', $providerUser->getEmail())
            ->first();

        if ($user) {
            return $user;
        }

        return User::create([
            'email' => $providerUser->getEmail(),
            'ten_hien_thi' => $providerUser->getName(),
            'provider_name' => $provider,
            'provider_id' => $providerUser->getId(),
            'hinh_dai_dien' => $providerUser->getAvatar(),
            'quyen_id' => 3
        ]);
    }
}
