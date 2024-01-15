@extends('admin.layouts.master')
@section('title', 'Order List Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            {{-- <a href="{{ route('product#createPage') }}">
                                <button class="btn btn-dark au-btn au-btn-icon au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add product
                                </button>
                            </a> --}}
                            <button class="btn btn-dark au-btn au-btn-icon au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>



                    @if(session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark me-2"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('updateSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{session('updateSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif



                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-dark">{{request('searchKey')}}</span> </h4>
                        </div>

                        <div class="col-3 btn bg-white shadow-sm px-3">
                            <h4>Total results <i class="fa-solid fa-database mx-2"></i><span id="resultCount">{{$orders->total()}}</span></h4>
                        </div>


                        <div class="col-5">
                            <form action="{{route('order#changeStatus')}}" method="GET" class="d-flex">
                                @csrf
                                <select name="orderStatus" id="orderStatus" class="form-control col-4 offset-1 me-3 rounded-3 shadow-sm">
                                    <option value="" @if(request('orderStatus') == '') selected @endif>All</option>
                                    <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                                    <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>

                                <input type="text" id="searchKey" name="searchKey" class="form-control me-3" id="" value="{{request('searchKey')}}" placeholder="Search...">
                                <button class="btn btn-dark" id="searchBtn" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>






                    @if (count($orders) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center"
                                style="border-collapse: separate; border-spacing: 0px 5px">
                                <thead>
                                    <tr class="" >

                                        <th class="fs-6">User ID</th>
                                        <th class="fs-6">User Name</th>
                                        <th class="fs-6">Order Code</th>
                                        <th class="fs-6">Amount</th>
                                        <th class="fs-6">Date</th>
                                        <th class="fs-6">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($orders as $order)
                                        <tr class="tr-shadow">
                                            <input type="hidden" name="" class="orderId" value="{{$order->id}}">
                                            <td class="">{{ $order->user_id }}</td>
                                            <td class="">{{ $order->user_name }}</td>
                                            <td class="">
                                                <a href="{{route('order#itemList',$order->order_code)}}" class="text-primary">{{ $order->order_code }}</a>
                                            </td>
                                            <td class="">{{ $order->total_price }}kyats</td>
                                            <td class="">{{ $order->created_at->format('F j, Y') }}</td>
                                            <td class="">
                                                <select name="status" class="form-control statusChange rounded-3">
                                                    <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                                    <option value="1" @if($order->status == 1) selected @endif>Accept</option>
                                                    <option value="2" @if($order->status == 2) selected @endif>Reject</option>
                                                </select>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{$orders->links()}}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Order Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){


        //change status
        $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $orderId = $parentNode.find('.orderId').val();

            $.ajax({
                type: 'get',
                url: '/order/ajax/change/status',
                data: {
                    'status':$currentStatus,
                    'orderId':$orderId,
                },
                dataType: 'json'
            });

            // location.reload();
        })

    })

</script>
@endsection


