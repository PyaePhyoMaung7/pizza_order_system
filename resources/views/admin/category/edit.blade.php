@extends('admin.layouts.master')
@section('title', 'Category Edit Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-2 offset-3">
                    <button class="btn bg-dark text-white my-3" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></button></a>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Your Category</h3>
                            </div>
                            <hr>
                            <form action="{{route('category#update')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="categoryId" value="{{$category->id}}">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="categoryName" value="{{old('categoryName',$category->name)}}" type="text" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('categoryName')
                                        <div class="invalid-feedback text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Save</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-floppy-disk"></i>
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
