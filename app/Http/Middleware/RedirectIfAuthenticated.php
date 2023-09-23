<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

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
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard) {
                if (Auth::guard($guard)->check()) {
                    switch ($guard) {
                        case 'admin':
                            return redirect()->route('admin.dashboard');

                        case 'dosen':
                            return redirect()->route('dosen.dashboard');

                        case 'mahasiswa':
                            return redirect()->route('mahasiswa.dashboard');

                        default:
                            return redirect()->route('index');
                    }
                }
            } else {
                if (Auth::check()) {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
