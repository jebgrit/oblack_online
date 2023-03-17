<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        if (Auth::check()) {
            $expire_time = Carbon::now()->addSeconds(30);

            Cache::put('user-is-online' . Auth::user()->id, true, $expire_time);

            User::where('id', Auth::user()->id)
                ->update([
                    'last_seen' => Carbon::now(),
                ]);
        }


        # si les roles ne correspondent pas, on redirige vers le dashboard principale
        if ($request->user()->role !== $role) {
            return response(view('errors.404'));
        }


        return $next($request);
    }
}
