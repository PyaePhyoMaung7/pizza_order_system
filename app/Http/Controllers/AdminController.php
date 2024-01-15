<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){

        // 1. all fields must be filled
        // 2. length min 6 max 10
        // 3. new password and confirm password must be the same
        // 4. old password must be the same with db password
        // 5. password change

        $this->passwordValidationCheck($request);

        $dbPassword = User::where('id',Auth::user()->id)->first()->password;

        if(Hash::check($request->oldPassword, $dbPassword)){
            $data = [
                'password'=>Hash::make($request->newPassword)
            ];

            User::where('id',Auth::user()->id)->update($data);

            // Auth::logout();

            return back()->with(['passwordChangeSuccess'=>'Password successfully changed!']);

            // return redirect()->route('auth#loginPage');


            // Auth::guard('web')->logout();

            // $request->session()->invalidate();

            // $request->session()->regenerateToken();

            // session()->flush();



        }
        return back()->with(['notMatch'=>'The old password does not match. Try Again!']);


    }

    //direct admin profile page
    public function details(){
        return view('admin.account.details');
    }

    //direct admin profile edit page
    public function edit(){
        return view('admin.account.edit');
    }

    //update admin profile
    public function update($id, Request $request){
        $this->infoValidationCheck($id, $request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){

            // 1. old image name => check ? delete: no-delete => store
            $dbImage = User::where('id',$id)->first()->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['infoUpdateSuccess'=>'Admin Account successfully updated!']);
    }

    //direct admin list
    public function list(){
        $admins = User::when(request('searchKey'),function($query){
          $query  ->where(function($inner){
                $inner->where('name','like','%'.request('searchKey').'%')
                ->orWhere('email','like','%'.request('searchKey').'%')
                ->orWhere('gender','like',request('searchKey'))
                ->orWhere('phone','like','%'.request('searchKey').'%')
                ->orWhere('address','like','%'.request('searchKey').'%');
            });
        })
        ->whereIn('role',['admin','super_admin'])
        ->paginate(3);

        $admins->appends(request()->all());
        return view('admin.account.list',compact('admins'));
    }

    //admin delete account
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin account deleted!']);
    }

    //change role page
    // public function changeRole($id){
    //     $account = User::where('id',$id)->first();
    //     return view('admin.account.changeRole',compact('account'));
    // }

    // //change role
    // public function change($id, Request $request){
    //     User::where('id',$id)->update(['role' => $request->role]);
    //     return redirect()->route('admin#list');

    // }

    //change role
    public function changeRole(Request $request){
        User::where('id',$request->adminId)
            ->update(['role'=>$request->role]);
    }

    //show message list
    public function messageList(){
        $messages = Contact::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%')
            ->orWhere('email','like','%'.request('searchKey').'%')
            ->orWhere('message','like','%'.request('searchKey').'%')
            ->orWhere('created_at','like','%'.request('searchKey').'%');
        })
        ->orderBy('created_at','desc')->paginate(3);

        $messages->appends(request()->all());
        return view('admin.contact.contact',compact('messages'));
    }

    //show full message
    public function showFullMessage($id){
        $fullMessage = Contact::where('id',$id)->first();
        return view('admin.contact.fullMessage',compact('fullMessage'));
    }

    //delete message
    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Message Successfully Deleted']);
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => ['required','min:6','max:15'],
            'newPassword' => ['required','min:6','max:15'],
            'confirmPassword' => ['required','min:6','max:15','same:newPassword']
        ])->validate();
    }




    //validate admin update info
    private function infoValidationCheck($id, $request){
        Validator::make($request->all(),[
            'name' => ['required'],
            'email' => ['required','unique:users,email,'.$id],
            'phone' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'image' => ['mimes:jpg,jpeg,webp,png','max:2048'],
        ])->validate();
    }

    //change user data to array
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }

}
