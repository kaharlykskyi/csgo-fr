<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatMassege;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(){
        $pageTitle = Auth::user()->name . ' chats';
        $chats = Chat::where('creator', Auth::user()->id)
            ->orWhere('recipient', Auth::user()->id)
            ->with('massage')->paginate(20);
        return view('chat.index',compact('pageTitle','chats'));
    }

    public function sendMassage(Request $request){
        $user = User::where('name',$request->name)->first();
        $pageTitle = 'Chat with ' . $user->name;

        if ($request->isMethod('post')){
            $private_chat = DB::table('chats')
                ->where('creator', Auth::user()->id)
                ->orWhere('recipient', Auth::user()->id)->first();
            if (!isset($private_chat)){
                $chat = new Chat();
                $chat->fill([
                    'creator' => Auth::user()->id,
                    'recipient' => $user->id
                ]);
                 $chat->save();
                $private_chat = $chat;
            }

            $massage = new ChatMassege();
            $massage->fill([
                'sender' => Auth::user()->id,
                'addressee' => $user->id,
                'chat_id' => $private_chat->id,
                'massage' => $request->massage
            ]);
            $massage->save();
            return back();
        }

        DB::table('chat_masseges')->where('addressee',Auth::user()->id)->update(['seen' => 1]);

        $private_chat = Chat::where('creator', Auth::user()->id)
            ->orWhere('recipient', Auth::user()->id)
            ->with('massage')
            ->first();

        $massages = null;
        if (isset($private_chat->massage)){
            $massages = $private_chat->massage()->paginate(20);
        }

        return view('chat.private_chat', compact('user','pageTitle','massages'));
    }
}
