<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\ConfirmEmail;
use Illuminate\Validation\Rule;

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
                die();
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

    public function uploadAvatar(Request $request){

        if($request->hasFile('logo_user')){
            $file = $request->file('logo_user');
            $logo_user = $file->getClientOriginalName();
            $file->move(public_path() . '/assets/images/user_avatar/',$logo_user);

            DB::table('users')->where('id', Auth::user()->id)->update(['logo_user' => $logo_user]);
        }

        return back()->with('status','Photo Uploaded');
    }

    public function deleteAvatar(Request $request){
        DB::table('users')->where('id', Auth::user()->id)->update(['logo_user' => null]);
        unlink(public_path() . '/assets/images/user_avatar/' . $request->get('avatar'));
        return back()->with('status','Photo Deleted');
    }

    public function editProfile(Request $request){
        if ($request->isMethod('post')){
            $data = $request->except('_token');

            $validate = Validator::make($data,[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'city' => 'required|string',
                'date_birth' => 'required|date',
                'sex' => ['required',Rule::in(['male', 'female'])]
            ]);

            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }

            DB::table('users')->where('id',Auth::user()->id)->update($data);

            return redirect()->route('profile')->with('status','Info Updated');
        }

        $countries = DB::table('countrys')->get();
        return view('profile.edit', compact('countries'));
    }

    public function changePassword(Request $request){
        if ($request->isMethod('post')){

            $data = $request->except('_token');

            $user = DB::table('users')->where('id',Auth::user()->id)->first();

            if ( Hash::check($data['password'], $user->password)){

                $validate = Validator::make($data,[
                    'password' => 'required|string|min:6',
                    'new_password' => 'required|string|min:6'
                ]);

                if ($validate->fails()) {
                    return redirect()->back()
                        ->withErrors($validate)
                        ->withInput();
                }

                if ($data['new_password'] == $data['password_confirmation']){
                    DB::table('users')->where('id',Auth::user()->id)->update(['password' => Hash::make($data['new_password'])]);

                    return redirect()->route('profile')->with('status','Password Changed');
                } else {
                    return back()->with('status','New Password not confirm');
                }
            } else {
                return back()->with('status','Old Password incorrect');
            }
        }

        return view('profile.change_password');
    }
}
