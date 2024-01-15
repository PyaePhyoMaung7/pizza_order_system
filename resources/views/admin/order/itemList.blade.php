@extends('admin.layouts.master')
@section('title', 'Order Items List Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-2">
                    <button class="btn bg-dark text-white my-3" onclick = "history.back()"><i class="fa-solid fa-arrow-left"></i></button>
                </div>

                <div class="col-7">
                    <div class="card mb-3">
                        <div class="card-header">

                            <h4><i class="fa-solid fa-clipboard me-2"></i>Order Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-4"><i class="fa-solid fa-user me-2"></i> Customer </div>
                                <div class="col">{{strtoupper($orderItems[0]->user_name)}}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                <div class="col">{{strtoupper($orderItems[0]->order_code)}}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4"><i class="fa-solid fa-money-bill-wave me-2"></i> Total</div>
                                <div class="col">{{$total }} kyats <small class="ms-3">(delivery charges included)</small></div>
                            </div>

                            <div class="row">
                                <div class="col-4"><i class="fa-solid fa-clock me-2"></i> Order Date</div>
                                <div class="col">{{strtoupper($orderItems[0]->created_at->format('F j, Y'))}}</div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <!-- DATA TABLE -->
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center"
                                style="border-collapse: separate; border-spacing: 0px 5px">
                                <thead>
                                    <tr class="" >
                                        <th style="font-size: 0.9rem">Order ID</th>
                                        <th style="font-size: 0.9rem">Product</th>
                                        <th style="font-size: 0.9rem">Image</th>
                                        <th style="font-size: 0.9rem">Qty</th>
                                        <th style="font-size: 0.9rem">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($orderItems as $orderItem)
                                        <tr>
                                            <td class="align-middle">{{$orderItem->id}}</td>
                                            <td>{{$orderItem->product_name}}</td>
                                            <td class="col-2">
                                                <img src="{{asset('storage/'.$orderItem->product_image)}}" class='w-100 object-fit-cover' style="height: 80px" alt="">
                                            </td>
                                            <td>{{$orderItem->qty}}</td>
                                            <td>{{$orderItem->total}}</td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{-- {{$orders->links()}} --}}
                            </div>
                        </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection



