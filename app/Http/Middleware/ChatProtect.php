<?php

namespace App\Http\Middleware;

use App\Chat;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class ChatProtect
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
        $user = User::where('name',$request->name)->first();
        $chat = Chat::where('creator',$user->id)->first();
        if (isset($chat)){
            if (Auth::user()->id != $chat->creator || Auth::user()->id != $chat->recipient){
                return back();
            }
        }
        return $next($request);
    }
}
