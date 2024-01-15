<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function orderList(){
        $orders = Order::select('orders.*','u.name as user_name')
                ->join('users as u','u.id','orders.user_id')
                ->orderBy('orders.created_at','desc')
                ->paginate(3);



        // $orders->appends(request()->all());
        return view('admin.order.orderList',compact('orders'));
    }

    //filter by status
    public function changeStatus(Request $request){

        $orders = Order::select('orders.*','u.name as user_name')
                        ->join('users as u','u.id','orders.user_id');



        if(isset($request->orderStatus)){
            $orders = $orders->where('status',$request->orderStatus);

        }

        if(request('searchKey')){
            $orders = $orders->where(function($query){
                $query->where('user_id','like','%'.request('searchKey').'%')
                ->orWhere('name','like','%'.request('searchKey').'%')
                ->orWhere('order_code','like','%'.request('searchKey').'%')
                ->orWhere('total_price','like','%'.request('searchKey').'%')
                ->orWhere('orders.updated_at','like','%'.request('searchKey').'%')
                ->orWhere('status','like','%'.request('searchKey').'%');
            });


        };

        $orders = $orders->orderBy('orders.created_at','desc')->paginate(3);

        $orders->appends(request()->all());

        return view('admin.order.orderList',compact('orders'));
    }

    //change status
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update(['status'=>$request->status]);
    }

    //order item list
    public function itemList($orderCode){
        $total = Order::where('order_code',$orderCode)->first()->total_price;
        $orderItems = OrderList::select('order_lists.*', 'u.name as user_name', 'p.name as product_name', 'p.image as product_image')
                    ->where('order_code',$orderCode)
                    ->join('users as u','u.id','order_lists.user_id')
                    ->join('products as p','p.id','order_lists.product_id')
                    ->get();
        return view('admin.order.itemList',compact('orderItems','total'));
    }
}
