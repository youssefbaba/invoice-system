<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;

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
    protected $redirectTo;
    public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 1:
                $this->redirectTo = "admin";
                return $this->redirectTo;
                break;
            case 0:
                $this->redirectTo = RouteServiceProvider::HOME;
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo  = "login";
                return $this->redirectTo;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider()
    {

        return FacadesSocialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {

            $user = FacadesSocialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('dash.chart');
            } else {
                if ($user->getEmail() == null) {
                    \session()->flash('email_missing', "S'il vous plait ajouter un email de contact au facebook.");
                    return redirect()->back();
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->id,
                        'password' => encrypt('123456dummy'),
                        'email_verified_at' => \Carbon\Carbon::now(),
                    ]);

                    Auth::login($newUser);

                    return redirect()->route('dash.chart');
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function redirectToProvider1()
    {
        return FacadesSocialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback1()
    {
        try {

            $user = FacadesSocialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('dash.chart');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'email_verified_at' => \Carbon\Carbon::now(),
                ]);

                Auth::login($newUser);

                return redirect()->route('dash.chart');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
