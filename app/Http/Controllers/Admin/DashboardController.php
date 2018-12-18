<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index(){
        return view('admin_area.dashboard');
    }

    public function users(Request $request){
        $user_sort_date = $request->user_sort_date;
        if ($request->isMethod('post')){
            $search = $request->search;
            $users = User::where('name','like',"%{$search}%")->paginate(40);
            return view('admin_area.users.index',compact('users','search'));
        }
        if (isset($user_sort_date)){
            if ($user_sort_date == 'true'){
                $users = User::orderBy('created_at', 'desc')->paginate(40);
            } else {
                $user_sort_date = null;
            }
        } else {
            $users = User::paginate(40);
        }
        return view('admin_area.users.index',compact('users','user_sort_date'));
    }

    public function access(Request $request){
        if ($request->access != -1){
            DB::table('users')->where('id',$request->id)->update(['access' => $request->access]);
        } elseif($request->access == -1 && Auth::user()->moderators === 'super_admin') {
            DB::table('users')->where('id',$request->id)->delete();
        }
        return 'Info updated';
    }

    public function moderators(Request $request){
        if ($request->moderators == 'admin' && Auth::user()->moderators === 'super_admin'){
            DB::table('users')->where('id',$request->id)->update([
                'moderators' => $request->moderators,
                'role' => 'admin'
            ]);
        } elseif ($request->moderators == 'user' && Auth::user()->moderators === 'super_admin'){
            DB::table('users')->where('id',$request->id)->update([
                'moderators' => $request->moderators,
                'role' => 'user'
            ]);
        }
        return 'Info updated';
    }

    public function announcement(Request $request){
        if ($request->isMethod('post')){
            $data = $request->except('_token');

            $validate = Validator::make($data,[
                'content' => 'required',
            ]);

            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }
            Storage::put('announcement.txt', $data['content']);
        }

        $announcement = null;
        $exists = Storage::disk()->exists('announcement.txt');
        if ($exists){
            $announcement = Storage::get('announcement.txt');
        }

        return view('admin_area.home_content.announcement', compact('announcement'));
    }

    public function settings(Request $request){
        $settings = DB::table('settings')->get();

        if ($request->isMethod('post')){
            $data = $request->except('_token');
            foreach ($data as $k => $iteam){
                DB::table('settings')->where('name',$k)->update(['value' => $iteam]);
            }
            return back();
        }

        return view('admin_area.settings',compact('settings'));
    }
}
