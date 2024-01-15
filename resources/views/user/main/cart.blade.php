@extends('user.layouts.master')

@section('title', 'Cart Page')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-2">
                <a href="{{route('user#home')}}">
                    <button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i></button>
                </a>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" >
                        @foreach ($cartList as $pizza)
                            <tr>
                                {{-- <input type="hidden" name="" id="pizza_price" value="{{$pizza->price}}"> --}}
                                <td class="align-middle " >
                                    <img src="{{asset('storage/'.$pizza->image)}}" class="me-3 object-fit-cover" style="width: 100px; max-height: 80px;" alt="">
                                </td>
                                <td class="align-middle">
                                    {{$pizza->name}}
                                    <input type="hidden" class="cartItemId" name="" value="{{$pizza->id}}">
                                    <input type="hidden" class="productId" name="" value="{{$pizza->product_id}}">
                                    <input type="hidden" class="userId" name="" value="{{$pizza->user_id}}">
                                </td>
                                <td class="align-middle" id="pizza_price">{{$pizza->price}} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm border-0 text-center"
                                            value="{{$pizza->qty}}" id='qty' min="0">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{$pizza->price * $pizza->qty}} kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{$subTotal}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium" id="deliveryFees">@if (count($cartList)==0) 0 kyats @else 3000 kyats @endif</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><span id="finalPrice">@if (count($cartList)==0) 0 @else {{$subTotal + 3000}} @endif</span> <span class="h6">kyats</span></h5>
                        </div>

                        <button id="orderBtn" class="btn btn-block btn-warning font-weight-bold my-3 py-3 " @if (count($cartList)==0) disabled @endif>
                            Proceed To Checkout
                        </button>

                        <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3 " @if (count($cartList)==0) disabled @endif>
                            Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('jsSource')
    <script src="{{asset('js/cart.js')}}">
    </script>

    <script>
        $(document).ready(function() {
            //remove a product
            $('.btn-remove').click(function(){
                let $parentNode = $(this).parents('tr');
                $cartItemId = $parentNode.find('.cartItemId').val();

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear/product',
                    data: {
                        'cartItemId':$cartItemId,
                    },
                    dataType: 'json',
                });

                $parentNode.remove();

                let $totalPrice = 0;
                $('#dataTable tbody tr').each(function(index, row){
                    $totalPrice += Number($(row).find('#total').text().replace('kyats',''));
                });

                $('#subTotal').html($totalPrice+' kyats');

                if($totalPrice == 0){
                    $('#deliveryFees').html('0 kyats');
                    $('#finalPrice').html('0');
                    $('#orderBtn, #clearBtn').attr('disabled',true);
                }else{
                    $('#deliveryFees').html('3000 kyats');
                    $('#finalPrice').html($totalPrice+3000);
                    $('#orderBtn, #clearBtn').attr('disabled',false);
                }

            });

            $('#orderBtn').click(function(){

                $orderCode = 'POS' + Math.floor(Math.random()*10000000000)
                $orderList = [];

                $('#dataTable tbody tr').each(function(index,row){
                    $orderList.push({
                        'user_id':$(row).find('.userId').val(),
                        'product_id':$(row).find('.productId').val(),
                        'qty':$(row).find('#qty').val(),
                        'total':Number($(row).find('#total').html().replace('kyats','')),
                        'order_code': $orderCode,
                    })
                })



                $.ajax({
                    type: 'get',
                    url: '/user/ajax/order',
                    data: Object.assign({},$orderList),
                    dataType: 'json',
                    success: function(response) {
                        if(response.status == 'true'){
                            window.location.href = '/user/home';
                        }
                    }
                });
            });

            //when clear cart button is clicked
            $('#clearBtn').click(function(){


                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear/cart',
                    dataType: 'json',
                });

                $('#dataTable tbody tr').remove();

                $('#subTotal').html('0 kyats');
                $('#deliveryFees').html('0 kyats');
                $('#finalPrice').html('0');
                $('#orderBtn, #clearBtn').attr('disabled',true);

            })



        });
    </script>
@endsection
