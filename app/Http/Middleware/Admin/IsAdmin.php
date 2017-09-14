<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $platform = Auth::user()->platform;
        $status = Auth::user()->status;

        if ( $platform != 1 && $platform != 2 ) {
            session()->flash('warning', '请登录后台账户');
            return redirect()->route('login');
        }

        if ($status == 0) {
            session()->flash('warning', '账户被禁用');
            return redirect()->route('login');
        }

        return $response;
    }
}
