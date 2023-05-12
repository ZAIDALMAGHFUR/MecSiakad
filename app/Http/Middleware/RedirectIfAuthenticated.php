<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // dd('drop out');
        if (Auth::check()) {
            if (Auth::user()->roles_id == 1)  {
                return redirect(RouteServiceProvider::HOME);
            }elseif (Auth::user()->roles_id == 2) {
                return redirect(RouteServiceProvider::DOSEN);
            } elseif (Auth::user()->roles_id == 3) {
                if (Auth::user()->mahasiswa->status == 'drop out') {
                    Auth::logout();
                    // $request->session()->invalidate();
                    // $request->session()->regenerateToken();
                    // return redirect('/login')->with('error', 'Anda tidak bisa login karena status anda drop out');
                    // return redirect('login')->with('error', 'Anda tidak bisa login karena status anda drop out');
                } else {
                    return redirect(RouteServiceProvider::MAHASISWA);
                }
            } elseif (Auth::user()->roles_id == 4) {
                return redirect(RouteServiceProvider::Calon);
            }
        }

        return $next($request);
    }
}
