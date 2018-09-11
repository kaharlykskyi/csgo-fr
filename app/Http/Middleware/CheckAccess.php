<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckAccess
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
        $user = User::where('email',$request->email)->first();
        if($user->accses == 0){
            return response()->json([
                'access' => 'You are banned',
            ]);
        }

        return $next($request);
    }
}
