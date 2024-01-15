<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        // logger($request->status);
        $data = Product::orderBy('created_at',$request->status)->get();
        return response()->json($data, 200);
    }

    //add to cart
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'status'=>'success',
            'message'=>'Added To The Cart'
        ];
        return response()->json($response, 200);
    }

    //order
    public function order(Request $request){

        $total = 0;

        foreach($request->all() as $item){

            $data = OrderList::create($item);

            $total += $item['total'];
        };

        Cart::where('user_id',Auth::user()->id)->delete();


        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=> $data->order_code,
            'total_price'=> $total+3000

        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'Order Completed'
        ], 200);

    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear product in the cart
    public function clearProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
            ->where('id',$request->cartItemId)
            ->delete();
    }

    //increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->product_id)->first();

        $viewCount = ['view_count' => $pizza->view_count + 1];

        Product::where('id',$request->product_id)->update($viewCount);
    }

    //get order data
    private function getOrderData($request){
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

}
