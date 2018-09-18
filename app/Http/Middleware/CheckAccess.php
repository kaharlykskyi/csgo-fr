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
        if(!isset($request->email)){
            return back();
        }

        $user = User::where('email',$request->email)->first();
        if($user->access == 0){
            return response()->json([
                'access' => 'You have been banned',
            ]);
        }

        return $next($request);
    }
}
