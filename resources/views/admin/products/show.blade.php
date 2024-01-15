@extends('admin.layouts.master')
@section('title', 'Product Details Page')

@section('content')

    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <@if(session('updateSuccess'))
                    <div class="col-6 offset-6 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{session('updateSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="col-lg-2 offset-1">
                    <a href="{{route('product#list')}}">
                        <button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i></button>
                    </a>

                </div>

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-4 offset-1">
                                    <img src="{{asset('storage/'.$pizza->image)}}" alt="" class="my-3">
                                </div>
                                <div class="col-6">
                                    <h4 class="my-3 fs-4">{{$pizza->name}}</h4>
                                    <span class="my-2 btn btn-sm btn-dark"> <i class="fa-solid fs-6 fa-money-bill-wave me-2"></i> {{$pizza->price}} kyats</span>
                                    <span class="my-2 btn btn-sm btn-dark"> <i class="fa-solid fs-6 fa-clock me-2"></i> {{$pizza->waiting_time}} mins</span>
                                    <span class="my-2 btn btn-sm btn-dark"> <i class="fa-solid fs-6 fa-eye me-2"></i> {{$pizza->view_count}}</span>
                                    <span class="my-2 btn btn-sm btn-dark"> <i class="fa-solid fs-6 fa-tag me-2"></i> {{$pizza->category}}</span>
                                    <span class="my-2 btn btn-sm btn-dark"> <i class="fa-solid fs-6 fa-user-clock me-2"></i> {{$pizza->created_at->format('F j, Y')}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 offset-1 ">
                                    <div class="my-2"><i class="fa-solid fs-5 fa-file-lines me-3"></i> Details </div>
                                    {{$pizza->description}}</div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
