@extends('layouts.master')

@section('title','Register Page')

@section('style')
    <style>
        .page-wrapper{
            height: 190vh;
        }
    </style>
@endsection

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            @error('terms')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full form-control @error('address') is-invalid @enderror" type="text" name="name" placeholder="Username" value={{old('name')}}>
                @error('name')
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full form-control @error('address') is-invalid @enderror" type="email" name="email" placeholder="Email"  value={{old('email')}}>
                @error('email')
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full form-control @error('address') is-invalid @enderror" type="number" name="phone" placeholder="09xxxxxxxxx"  value={{old('phone')}}>
                @error('phone')
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label>Gender</label>
                <select name="gender" id="" class="form-control @error('address') is-invalid @enderror"  value={{old('gender')}}>
                    <option value=''>Choose Your Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror" cols="30" rows="3">{{old('address')}}</textarea>
                @error('address')
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full form-control @error('address') is-invalid @enderror" type="password" name="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full form-control @error('address') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage')}}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
