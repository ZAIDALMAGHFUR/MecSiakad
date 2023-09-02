<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

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
    protected function redirectTo()
{
    if (Auth::user()->roles_id == 1) {
        return RouteServiceProvider::HOME;
    } elseif (Auth::user()->roles_id == 2) {
        return RouteServiceProvider::DOSEN;
    } elseif (Auth::user()->roles_id == 3) {
        if (auth()->user()->mahasiswa->status == 'drop out') {
            Auth::logout();
            Session::flush();
            Session::regenerate();
            toastr()->error('Anda tidak bisa login karena status anda drop out');
            return route('login');
        }
        return RouteServiceProvider::MAHASISWA;
    } elseif (Auth::user()->roles_id == 4) {
        return RouteServiceProvider::Calon;
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
}
