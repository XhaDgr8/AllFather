<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {

        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return Redirect::to('auth/'.$provider);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        if (is_string($authUser)) {
            return Redirect::to('/login')->withErrors([$authUser]);
        }

        Auth::login($authUser, true);

        return back();
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $theUser
     * @param $provider
     * @return User
     */
    private function findOrCreateUser($theUser, $provider)
    {
        $authUserEmail = User::where('email', $theUser->email)->first();
        if ($authUserEmail) {
            $authUser =  User::where('provider_id', $theUser->id)->where('email', $theUser->email)->first();
            if ($authUser) {
                return $authUser;
            } else {
                return "The email: " . $theUser->email . " is already registered with ".
                    $authUserEmail->provider_name = "" ?  $authUserEmail->provider_name:'direct email signup';
            }
        }

        $user = User::create([
            'name' => $theUser->name,
            'email' => $theUser->email,
            'provider_name' => $provider,
            'provider_id' => $theUser->id,
            'password' => hash::make($theUser->id),
            'avatar' => $theUser->avatar
        ]);

        $user->profile()->update([
            'user_name' => $theUser->name,
            'avatar' => $theUser->avatar
        ]);

        return $user;


    }
}
