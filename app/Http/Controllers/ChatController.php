<?php

namespace App\Http\Controllers;

use App\ChatMassege;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(){
        $pageTitle = Auth::user()->name . ' chats';
        $users = null;
        $users_id = null;
        $buff = DB::table('chat_masseges')->where('user',Auth::user()->id)
            ->orWhere('user2',Auth::user()->id)->get();
        if (isset($buff)){
            foreach ($buff as $item){
                if ($item->user != Auth::user()->id){
                    $users_id[] = $item->user;
                }
                if ($item->user2 != Auth::user()->id){
                    $users_id[] = $item->user2;
                }
            }
        }
        if (isset($users_id)){
            $users_id = array_unique($users_id);
            $users = DB::table('users')->whereIn('id',$users_id)->paginate(20);
        }
        return view('chat.index',compact('pageTitle','users'));
    }

    public function sendMassage(Request $request){
        $user = User::where('name',$request->name)->first();
        $pageTitle = 'Chat with ' . $user->name;

        if ($request->isMethod('post')){

            $massage = new ChatMassege();
            $massage->fill([
                'user' => Auth::user()->id,
                'user2' => $user->id,
                'massage' => $request->massage
            ]);
            $massage->save();
            return back();
        }

        DB::table('chat_masseges')->where([['user2',Auth::user()->id],['user',$user->id]])->update(['seen2' => 1]);

        $private_chat = ChatMassege::where([['user',Auth::user()->id],['user2',$user->id]])
            ->orWhere([['user2',Auth::user()->id],['user',$user->id]])->orderByDesc('created_at')->paginate(20);

        return view('chat.private_chat', compact('user','pageTitle','private_chat'));
    }
}
