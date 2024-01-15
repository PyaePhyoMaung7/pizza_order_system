@extends('admin.layouts.master')
@section('title', 'Product Create Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-2 offset-3">
                    <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i></button></a>
                </div>

                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Add New Product</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" value="{{old('pizzaName')}}" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name...">
                                    @error('pizzaName')
                                        <div class="invalid-feedback text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" id="">
                                        <option value="">Choose category for this product...</option>
                                        @foreach ($categories as $category )
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <div class="invalid-feedback text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" id="" cols="30" rows="5" placeholder="Enter Description...">{{old('pizzaDescription')}}</textarea>
                                    @error('pizzaDescription')
                                        <div class="invalid-feedback text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="pizzaImage" value="{{old('pizzaImage')}}" type="file" class="form-control @error('pizzaImage') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Upload Pizza Image...">
                                    @error('pizzaImage')
                                        <div class="invalid-feedback text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="pizzaWaitingTime" value="{{old('pizzaWaitingTime')}}" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Waiting Time...">
                                    @error('pizzaWaitingTime')
                                        <div class="invalid-feedback text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" value="{{old('pizzaPrice')}}" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price...">
                                    @error('pizzaPrice')
                                        <div class="invalid-feedback text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
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
