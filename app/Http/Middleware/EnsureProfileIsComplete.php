<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Silahkan login untuk melakukan reservasi.');
        }

        $user = Auth::user();

        if ($user) {
            $profile = $user->profile;

            if (!$profile || !$profile->isComplete()) {
                return redirect()->route('profile.index')->with('error', 'Silahkan lengkapi profile anda terlebih dahulu.');
            }
        }

        return $next($request);
    }
}
