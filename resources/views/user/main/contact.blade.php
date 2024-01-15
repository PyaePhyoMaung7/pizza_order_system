@extends('user.layouts.master')

@section('title', 'Contact Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-2 offset-3">
                    <a href="{{route('user#home')}}">
                        <button type="button" class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i></button>
                    </a>

                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Contact Admin Team</h3>
                            </div>
                            <hr>

                            @if(session('successSent'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-cloud-arrow-up me-2"></i> {{session('successSent')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif


                            <form action="{{route('user#sendMessage')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name"  type="text" value="{{old('name',Auth::user()->name)}}" class="form-control @error('name') is-invalid mb-1 @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name ...">
                                            @error('name')
                                                <div class="invalid-feedback text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email"  type="email" value="{{old('email',Auth::user()->email)}}" class="form-control @error('email') is-invalid mb-1 @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email ...">
                                            @error('email')
                                                <div class="invalid-feedback text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Message</label>
                                        <textarea class="form-control" name="userMessage" id="cc-pament" cols="30" rows="5" @error('userMessage') is-invalid mb-1 @enderror placeholder="Write Your userMessage Here ...">{{old('userMessage')}}</textarea>
                                        @error('userMessage')
                                            <div class="invalid-feedback text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                        <i class="fa-solid fa-paper-plane me-2"></i>
                                        <span id="payment-button-amount">Send</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
