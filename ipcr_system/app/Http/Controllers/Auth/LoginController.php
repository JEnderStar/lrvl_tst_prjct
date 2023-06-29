<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laratrust\Laratrust;
use Illuminate\Http\Request;

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

    protected function authenticated(Request $request, $user)
    {
        if (Auth::check()) {
            //get the logged user
            $user = Auth::user();
            //get laratrust
            $laratrust = app(Laratrust::class);

            //check which role the user has, then redirects to its specific role's home page
            if ($laratrust->hasRole('employee', $user)) {
                return redirect('/employee');
            } elseif ($laratrust->hasRole('division_chief', $user)) {
                return redirect('/approvedc');
            } elseif ($laratrust->hasRole('director', $user)) {
                return redirect('/approvedir');
            } elseif ($laratrust->hasRole('hr', $user)) {
                return redirect('/hr');
            }
        }

        return redirect('/home');
    }
}
