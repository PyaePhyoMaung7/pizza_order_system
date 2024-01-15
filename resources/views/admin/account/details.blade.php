@extends('admin.layouts.master')
@section('title', 'Admin Details')

@section('content')

    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="d-flex ">
                    <div class="col-lg-2 offset-1">
                        <a href="{{route('category#list')}}">
                            <button class="btn bg-dark text-white my-3"><i
                                class="fa-solid fa-arrow-left"></i></button>
                        </a>

                    </div>

                    @if (session('infoUpdateSuccess'))
                        <div class="col-6 offset-2 ">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check me-2"></i> {{ session('infoUpdateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Details</h3>
                            </div>
                            <hr>
                            <div class="row d-flex align-items-center ">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/default_male.jpg') }}" class="shadow-sm"
                                                alt="">
                                        @else
                                            <img src="{{ asset('image/default_female.webp') }}" class="shadow-sm"
                                                alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt="{{ Auth::user()->name }}" />
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <form action="">
                                        <h4 class="my-3"> <i class="fa-solid fa-user-pen me-2"></i>
                                            {{ Auth::user()->name }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-envelope me-2"></i>
                                            {{ Auth::user()->email }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-phone me-2"></i> {{ Auth::user()->phone }}
                                        </h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-venus-mars me-2"></i>
                                            {{ Auth::user()->gender }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-location-dot me-2"></i>
                                            {{ Auth::user()->address }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-user-clock me-2"></i>
                                            {{ Auth::user()->created_at->format('F j, Y') }}</h4>
                                    </form>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-3 offset-2 text-center">
                                    <a href="{{ route('admin#edit') }}" class="">
                                        <button class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit profile
                                        </button>
                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
