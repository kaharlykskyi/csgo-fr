<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Config,DB,Hash,Mail,Validator};
use Illuminate\Support\Str;
use App\Mail\ConfirmEmail;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(){
        $count_forum_topics_profile = DB::table('settings')->where('name','=','count_forum_topics_profile')->select('value')->first();
        $count_topic_posts_profile = DB::table('settings')->where('name','=','count_topic_posts_profile')->select('value')->first();
        $count_comments_profile = DB::table('settings')->where('name','=','count_comments_profile')->select('value')->first();

        $last_forum_mass = DB::table('thread_posts')
            ->join('topic_threads','thread_posts.thread_id', '=', 'topic_threads.id')
            ->join('forum_topics','topic_threads.topic_id', '=', 'forum_topics.id')
            ->select(['thread_posts.*','forum_topics.id as id_topic','topic_threads.id as id_thread'])
            ->where('topic_threads.state','!=',0)
            ->orderByDesc('created_at')
            ->limit((int)$count_topic_posts_profile->value)
            ->get();
        $last_forum_topic = DB::table('topic_threads')
            ->join('forum_topics','topic_threads.topic_id', '=', 'forum_topics.id')
            ->select(['topic_threads.*','forum_topics.id as id_topic'])
            ->orderByDesc('topic_threads.created_at')
            ->limit((int)$count_forum_topics_profile->value)
            ->get();
        $pageTitle = Auth::user()->name . ' profile';

        $match_comments = DB::table('comments_match')->orderByDesc('created_at')->limit(10)->get();
        $news_comments = DB::table('news_comments')->orderByDesc('created_at')->limit(10)->get();
        $tournament_comments = DB::table('tournament_comments')->orderByDesc('created_at')->limit(10)->get();

        foreach ($match_comments as $comment){
            $comments [] = $comment;
        }
        foreach ($news_comments as $comment){
            $comments [] = $comment;
        }
        foreach ($tournament_comments as $comment){
            $comments [] = $comment;
        }

        if(isset($comments)){
            usort($comments, function($a,$b){
                return strcmp($b->created_at,$a->created_at);
            });
        }

        $comments = array_slice($comments,0,(int)$count_comments_profile->value);

        return view('profile.index',compact('pageTitle','last_forum_mass','last_forum_topic','comments'));
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
                'sex' => ['required',Rule::in(['male', 'female'])],
                'steam_profile' => 'nullable|url',
                'twitch_profile' => 'nullable|url',
                'faceit_profile' => 'nullable|url',
                'youtube_profile' => 'nullable|url',
                'instagram_profile' => 'nullable|url',
                'twitter_profile' => 'nullable|url',
            ]);

            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }

            $data['description'] = strip_tags($data['description']);

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

    public function showProfile(Request $request){
        $user_name = $request->name;
        $user = User::where('name',$user_name)->first();
        $pageTitle = $user->name . ' profile';
        return view('profile.show_profile',compact('user','pageTitle'));
    }
}
