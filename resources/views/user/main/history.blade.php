@extends('user.layouts.master')

@section('title', 'Order History Page')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 75vh">
        <div class="row px-xl-5">
            <div class="col-lg-2 offset-2">
                <a href="{{route('user#home')}}">
                    <button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i></button>
                </a>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" >
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">{{$order->created_at->format('F j, Y')}}</td>
                                <td class="align-middle">{{$order->order_code}}</td>
                                <td class="align-middle">{{$order->total_price}} kyats</td>
                                <td class="align-middle fw-bold fs-6">
                                    @if ($order->status == 0)
                                    <span class="text-warning"><i class="fa-regular fa-clock me-2"></i>Pending...</span>
                                    @elseif($order->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check me-2"></i>Accepted</span>
                                    @else
                                        <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Rejected</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-4">
                    {{$orders->links()}}
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('jsSource')

@endsection
