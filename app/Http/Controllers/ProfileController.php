<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ConfirmEmail;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index');
    }

    public function sendConfirm(){
        $user_email = Auth::user()->email;
        $email_token = Str::random(100);
        try{
            Mail::to($user_email)->send(new ConfirmEmail($user_email,$email_token));
        }catch (\Exception $e){
            if (Config::get('app.debug')){
                dump($e->getMessage());
            } else {
                return redirect()->route('profile')->with('status','Error send email!!');
            }
        }

        DB::table('users')->where('email', Auth::user()->email)->update([
            'mail_token' => $email_token,
            'is_verified' => 1
        ]);

        return redirect()->route('profile');
    }

    public function confirmEmail(Request $request){
        $email_token = DB::table('users')->where('email', Auth::user()->email)->value('mail_token');
        if(Auth::user()->email == $request->email && $email_token == $request->token){
            DB::table('users')->where('email', Auth::user()->email)->update([
                'mail_token' => null,
                'is_verified' => 2
            ]);
            $report = "Your email is confirmed";
            return view('common_component.mail_confirm_component',compact('report'));
        } else {
            $report = "Your email is not confirmed";
            return view('common_component.mail_confirm_component',compact('report'));
        }

    }
}
