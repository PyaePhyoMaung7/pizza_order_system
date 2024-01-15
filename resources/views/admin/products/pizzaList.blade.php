@extends('admin.layouts.master')
@section('title', 'Product List Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="btn btn-dark au-btn au-btn-icon au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add product
                                </button>
                            </a>
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

                        <div class="col-3 btn bg-white shadow-sm px-3 ">
                            <h4>Total results <i class="fa-solid fa-database mx-2"></i>{{$pizzas->total()}}</h4>
                        </div>

                        <div class="col-3 offset-2">
                            <form action="{{route('product#list')}}" method="GET" class="d-flex">
                                @csrf
                                <input type="text" name="searchKey" class="form-control me-3" id="" value="{{request('searchKey')}}" placeholder="Search...">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center"
                                style="border-collapse: separate; border-spacing: 0px 5px">
                                <thead>
                                    <tr class="" >
                                        <th class="" style="font-size: 0.9rem">Image</th>
                                        <th class="" style="font-size: 0.9rem">Name</th>
                                        <th class="" style="font-size: 0.9rem">Price</th>
                                        <th class="" style="font-size: 0.9rem">Category</th>
                                        <th class="" style="font-size: 0.9rem">View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow ">
                                            <td class="col-2"><img src="{{asset('storage/'.$pizza->image)}}" style="height: 80px" class='w-100 object-fit-cover' alt=""></td>
                                            <td class="">{{ $pizza->name }}</td>
                                            <td class="">{{ $pizza->price }}</td>
                                            <td class="">{{$pizza->category}}</td>
                                            <td class=""><i class="fa-solid fa-eye me-2"></i> {{$pizza->view_count}}</td>
                                            <td class="">
                                                <div class="table-data-feature">
                                                    <a href="{{route('product#show',$pizza->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('product#editPage',$pizza->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{route('product#delete',$pizza->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{$pizzas->links()}}
                            </div>


                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Pizza Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection
