<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user home page
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','history'));
    }

    //filter pizzas
    public function filter($categoryId){
        $pizzas = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','history'));
    }

    //direct change password page
    public function changePasswordPage(){
        return view('user.account.changePassword');
    }

    //direct acount details change page
    public function accountChangePage(){
        return view('user.account.profileEdit');
    }

    //account details change
    public function accountChange($id, Request $request){
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
        return back()->with(['updateSuccess'=>'User Account successfully updated!']);
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
            $dbPassword = User::where('id',Auth::user()->id)->first()->password;

            if(Hash::check($request->oldPassword, $dbPassword)){
                $data = [
                    'password'=>Hash::make($request->newPassword)
                ];
                User::where('id',Auth::user()->id)->update($data);
                return back()->with(['passwordChangeSuccess'=>'Password successfully changed!']);

            }
            return back()->with(['notMatch'=>'The old password does not match. Try Again!']);


    }

    //direct pizza details page
    public function pizzaDetails($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //direct cart list page
    public function cartList(){
        $cartList = Cart::select('carts.*','p.name','p.price','p.image')
                    ->where('user_id',Auth::user()->id)
                    ->join('products as p','p.id','carts.product_id')
                    ->get();
        $subTotal = 0;
        foreach($cartList as $pizza){
            $subTotal += $pizza->price * $pizza->qty;
        }
        return view('user.main.cart',compact('cartList','subTotal'));
    }

    //direct history page
    public function history(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('orders'));
    }

    //direct contact page
    public function contactForm(){
        return view('user.main.contact');
    }

    //send contact message
    public function sendMessage(Request $request){
        $this->messageValidationCheck($request);

        $data = $this->getUserMessage($request);

        Contact::create($data);

        return back()->with(['successSent'=>'Message Successfully Sent.']);
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => ['required','min:6','max:15'],
            'newPassword' => ['required','min:6','max:15'],
            'confirmPassword' => ['required','min:6','max:15','same:newPassword']
        ])->validate();
    }

    //validate user update info
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

    //message check
    private function messageValidationCheck($request){
        Validator::make($request->all(),[
            'name' => ['required','min:5', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'userMessage' => ['required','min:10','max:500']
        ])->validate();
    }

    //change user message data to array
    private function getUserMessage($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->userMessage,
        ];
    }
}
