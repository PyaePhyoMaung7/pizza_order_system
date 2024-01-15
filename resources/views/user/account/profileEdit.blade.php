@extends('user.layouts.master')

@section('title', 'User Profile Edit Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="d-flex">
                    <div class="col-lg-2 offset-1">
                        <button class="btn bg-dark text-white my-3" onclick="history.back()"><i
                                class="fa-solid fa-arrow-left"></i>
                        </button>
                    </div>
                    @if(session('updateSuccess'))
                        <div class="col-4 offset-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{session('updateSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">User Profile</h3>
                            </div>
                            <hr>


                            <form action="{{ route('user#accountChange', [Auth::user()->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="form-group">
                                            <label for="" class="control-label">Profile Picture</label>
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/default_male.jpg') }}" class="shadow-sm w-100"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset('image/default_female.webp') }}" class="shadow-sm w-100"
                                                        alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    alt="{{ Auth::user()->name }}" class="shadow-sm w-100" />
                                            @endif
                                            <div class="mt-3">
                                                <input type="file" name="image"
                                                    class="form-control @error('image') is-invalid mb-1 @enderror"
                                                    id="">
                                                @error('image')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="mt-3">

                                            <button type="submit" class="btn btn-dark w-100"><i
                                                    class="fa-solid fa-floppy-disk me-2 "></i>Save</button>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Name</label>
                                                <input id="cc-pament" name="name" type="text"
                                                    value='{{ old('name', Auth::user()->name) }}'
                                                    class="form-control @error('name') is-invalid mb-1 @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Admin Name">
                                                @error('name')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Email</label>
                                                <input id="cc-pament" name="email" type="email"
                                                    value='{{ old('email', Auth::user()->email) }}'
                                                    class="form-control @error('email') is-invalid mb-1 @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Admin Email">
                                                @error('email')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Phone</label>
                                                <input id="cc-pament" name="phone" type="number"
                                                    value='{{ old('phone', Auth::user()->phone) }}'
                                                    class="form-control @error('phone') is-invalid mb-1 @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Admin Phone Number">
                                                @error('phone')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Gender</label>
                                                <select name="gender" id="" class="form-control">
                                                    <option value="">Choose Your Gender...</option>
                                                    <option value="male"
                                                        @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                    <option value="female"
                                                        @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label ">Address</label>
                                                <textarea name="address" id="" cols="10" rows="3"
                                                    class="form-control @error('address') is-invalid mb-1 @enderror" placeholder="Enter Admin Address">{{ old('address', Auth::user()->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Role</label>
                                                <input id="cc-pament" name="role" type="text"
                                                    value='{{ old('role', Auth::user()->role) }}'
                                                    class="form-control @error('role') is-invalid mb-1 @enderror"
                                                    aria-required="true" aria-invalid="false" placeholder="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
