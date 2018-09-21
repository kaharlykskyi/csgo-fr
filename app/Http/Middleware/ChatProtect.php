<?php

namespace App\Http\Middleware;

use App\Chat;
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
        $chat = Chat::where('creator',Auth::user()->id)->orWhere('recipient',Auth::user()->id)->first();
        if (!isset($chat)){
            return back();
        }
        return $next($request);
    }
}
