<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products = Product::orderBy('created_at','desc')->get();

        return response()->json($products, 200);
    }

    //get a single product
    public function product($id){
        $product = Product::where('id',$id)->first();

        return response()->json($product, 200);
    }

    //get all category list
    public function categoryList(){
        $categories = Category::orderBy('created_at','desc')->get();

        return response()->json($categories, 200);
    }

    //get a single category
    public function category($id){
        $category = Category::where('id',$id)->first();

        return response()->json($category, 200);
    }

    //get user list
    public function userList(){
        $users = User::where('role','user')
                    ->orderBy('created_at','desc')
                    ->get();

        return response()->json($users, 200);
    }

    //get a single user
    public function user($id){
        $user = User::where('role','user')
                    ->where('id',$id)->first();

        return response()->json($user, 200);
    }

    //get admin list
    public function adminList(){
        $users = User::whereIn('role',['admin','super_admin'])
                    ->orderBy('created_at','desc')
                    ->get();

        return response()->json($users, 200);
    }

    //get a single admin
    public function admin($id){
        $admins = User::whereIn('role',['admin','super_admin'])
                        ->where('id',$id)
                        ->get();

        return response()->json($admins, 200);
    }

    //get order list
    public function orderList(){
        $orders = Order::select('orders.id as order_id','users.name as user_name','order_code','total_price','status')
                    ->join('users','users.id','orders.user_id')
                    ->orderBy('orders.created_at','desc')
                    ->get();

        return response()->json($orders, 200);
    }

    //get order list
    public function order($id){
        $orders = Order::select('orders.id as order_id','users.name as user_name','order_code','total_price','status')
                    ->where('orders.id',$id)
                    ->join('users','users.id','orders.user_id')
                    ->get();

        return response()->json($orders, 200);
    }

    //get contact list
    public function contactList(){
        $contacts = Contact::orderBy('created_at','desc')->get();

        return response()->json($contacts, 200);
    }

    //get a single contact message
    public function contact($id){
        $contact = Contact::where('id',$id)->get();

        return response()->json($contact, 200);
    }

    //create category
    public function createCategory(Request $request){
        // dd($request->header('Accept')); header data retrieval
        // dd($request->name); body data retrieval
        $data = [
            'name'=>$request->category_name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];

        $response = Category::create($data);

        return response()->json($response, 200);
    }

    //delete category
    public function deleteCategory($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>true,'message'=>'Category Successfully Deleted','deletedData'=>$data], 200);
        }else{
            return response()->json(['status'=>false,'message'=>'No Category with this Id'], 500 );
        }

    }

    //update category
    public function updateCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            $data = $this->getCategoryData($request);
            $data = Category::where('id',$request->category_id)->update($data);
            $data = Category::where('id',$request->category_id)->first();
            return response()->json(['status'=>true,'message'=>'Category Successfully Updated','updatedData'=>$data], 200);
        }else{
            return response()->json(['status'=>false,'message'=>'No Category with this Id'], 500 );
        }
    }

    private function getCategoryData($request){
        return [
            'name'=>$request->category_name,
            'updated_at'=>Carbon::now()
        ];
    }


    //create contact
    public function createContact(Request $request){
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];

        $response = Contact::create($data);

        return response()->json($response, 200);
    }

    //delete contact
    public function deleteContact($id){
        $message = Contact::where('id',$id)->first();

        if(isset($message)){
            Contact::where('id',$id)->delete();
            return response()->json(['status'=>true,'message'=>'Message Successfully Deleted','deletedMessage'=>$message], 200);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no message with this Id'], 500);
        }
    }

    //delete user // key--> user_id
    public function deleteUser(Request $request){
        $user = User::where('id',$request->user_id)->first();

        if(isset($user)){
            User::where('id',$request->user_id)->delete();
            return response()->json(['status'=>true,'message'=>'User Successfully Deleted','deletedUser'=>$user], 200);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no user with this Id'], 500);
        }
    }

    //create user
    // public function createUser(Request $request){
    //     $this->validateUser($request);
    //     $data = $this->getUserData($request);

    //     return redirect()->route('register',$data);
    // }

    // //validate user
    // private function validateUser($request){
    //     Validator::make($request->all(),[
    //         'name' => ['required','string', 'max:255'],
    //         'email' => ['required','email', 'max:255', Rule::unique('users')],
    //         'gender' => ['required',Rule::in(['male','female'])],
    //         'phone' => ['required', 'min:11', 'max:15'],
    //         'address' => ['required','min:3'],
    //         'role' => ['required',Rule::in(['user'])],
    //         'password' => ['required','min:6','max:15'],
    //     ])->validate();
    // }

    // //get user data
    // private function getUserData($request){
    //     return [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'gender' => $request->gender,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //         'role' => $request->role,
    //         'password' => Hash::make($request->password)
    //     ];
    // }


}
