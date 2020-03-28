<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
	public function redirect()
	{
		return Socialite::driver('github')->redirect();
	}

	public function handleCallback()
	{
		$gitUser = Socialite::driver('github')->user();
		$user = User::where('email', $gitUser->getEmail())->first();

		if (!$user) {
			$user = User::create([
				'name' => $gitUser->getName(),
				'email' => $gitUser->getEmail(),
				'password' => bcrypt($gitUser->token)
			]);
		}
		Auth::login($user);

		if (!$user->socials()->where('driver', 'github')->first()) {
			$user->socials()->create([
				'driver' => 'github',
				'token' => $gitUser->token
			]);
		}

		$token = $user->tokens()->where('driver', 'github')->first();

		if (!$token) {
			$token = $user->createToken('web')->accessToken;
			$token->driver = 'github';
			$token->save();
		}

		return redirect()->route('home');
	}

	public function info(Request $request)
	{
		$social = $request->user()->socials()->where('driver', 'github')->first();

		if ($social) {
			$user = Socialite::driver('github')->userFromToken($social->token);

			return view('github', [
				'user' => $user
			]);
		}
		else
			return redirect()->route('github.login');
	}
}