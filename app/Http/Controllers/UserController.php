<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //direct user list page
    public function userList(){
        $users = User::when(request('searchKey'),function($query){
            $query  ->where(function($inner){
                  $inner->where('name','like','%'.request('searchKey').'%')
                  ->orWhere('email','like','%'.request('searchKey').'%')
                  ->orWhere('gender','like',request('searchKey'))
                  ->orWhere('phone','like','%'.request('searchKey').'%')
                  ->orWhere('address','like','%'.request('searchKey').'%');
              });
          })
          ->where('role','user')
          ->orderBy('created_at','desc')
          ->paginate(3);
        $users->appends(request()->all());
        return view('admin.user.list',compact('users'));
    }

    //user change role
    public function changeRole(Request $request){
        User::where('id',$request->userId)
            ->update(['role'=>$request->role]);
    }

    //user delete account
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User account deleted!']);
    }
}
