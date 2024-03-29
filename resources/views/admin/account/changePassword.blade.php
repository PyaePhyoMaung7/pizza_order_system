@extends('admin.layouts.master')
@section('title', 'Change Password Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-2 offset-3">
                    <button class="btn bg-dark text-white my-3" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></button>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>

                            @if(session('passwordChangeSuccess'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-cloud-arrow-up me-2"></i> {{session('passwordChangeSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('notMatch'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i> {{session('notMatch')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword"  type="password" class="form-control @error('oldPassword') is-invalid mb-1 @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                                        @error('oldPassword')
                                            <div class="invalid-feedback text-danger">
                                                {{$message}}
                                            </div>

                                        @enderror


                                    </div>

                                    <div class="mb-3">
                                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword"  type="password" class="form-control @error('newPassword') is-invalid mb-1 @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                        @error('newPassword')
                                            <div class="invalid-feedback text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="confirmPassword"  type="password" class="form-control @error('confirmPassword') is-invalid mb-1 @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Passwrod Again">
                                        @error('confirmPassword')
                                            <div class="invalid-feedback text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa-solid fa-key me-2"></i>
                                        <span id="payment-button-amount">Change Password</span>
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
