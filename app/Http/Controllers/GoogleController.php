<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
	public function redirect()
	{
		return Socialite::driver('google')->redirect();
	}

	public function handleCallback()
	{
		$googleUser = Socialite::driver('google')->user();
		$user = User::where('email', $googleUser->getEmail())->first();

		if (!$user) {
			$user = User::create([
				'name' => $googleUser->getName(),
				'email' => $googleUser->getEmail(),
				'password' => bcrypt($googleUser->token)
			]);
		}
		Auth::login($user);

		if (!$user->socials()->where('driver', 'google')->first()) {
			$user->socials()->create([
				'driver' => 'google',
				'token' => $googleUser->token
			]);
		}

		$token = $user->tokens()->where('driver', 'google')->first();

		if (!$token) {
			$token = $user->createToken('web')->accessToken;
			$token->driver = 'google';
			$token->save();
		}

		return redirect()->route('home');
	}

	public function info(Request $request)
	{
		$social = $request->user()->socials()->where('driver', 'google')->first();

		if ($social) {
			$user = Socialite::driver('google')->userFromToken($social->token);

			return view('google', [
				'user' => $user
			]);
		}
		else
			return redirect()->route('google.login');
	}
}