<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
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
        if (!Auth::guard('web')->user() || !Auth::guard('web')->user()->email_verified_at) {
            Auth::guard('web')->logout();

            $notification = array(
                'message' => "Vous devez confirmer votre compte. Nous vous avons envoyé un lien d'activation, consultez vos emails.",
                'alert-type' => 'error'
            );

            return redirect()->route('login')
                ->with($notification)
                ->withInput();
        }
        return $next($request);
    }
}
