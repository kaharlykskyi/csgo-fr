<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return view('admin_area.dashboard');
    }

    public function users(){
        $users = User::paginate(40);
        return view('admin_area.users.index',compact('users'));
    }

    public function search(Request $request){
        $search = $request->search;
        $users = User::where('name','like',"%{$search}%")->paginate(40);
        return view('admin_area.users.index',compact('users','search'));
    }

    public function access(Request $request){
        DB::table('users')->where('id',$request->id)->update(['accses' => $request->accses]);
        return 'Info updated';
    }
}
