<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        
        if ($user->hasRole($role)) {
            return $next($request);
        }
        
        // Jika peran yang login adalah "user", arahkan ke route "user.home"
        if ($user->hasRole('saksi')) {
            
            return redirect()->route('saksi.home')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }
        
        // Jika peran yang login bukan "user" atau peran lainnya, arahkan ke halaman "home"
        return redirect('home')->with('error', 'Anda tidak memiliki akses');
    }
    
}
