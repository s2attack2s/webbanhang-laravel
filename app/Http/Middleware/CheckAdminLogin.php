<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // nếu user đã đăng nhập

        try {
            if (Auth::check()) {
                $user = Auth::user();
                // nếu level =1 (admin) thì cho qua.
                if ($user->role == 1) {
                    return $next($request);
                } else {
                    return redirect()->route('Home');
                }
            } else {
                return redirect()->route('Login');
            }
        } catch (\Exception $e) {
            return redirect()->route('Error');
        }
    }
}
