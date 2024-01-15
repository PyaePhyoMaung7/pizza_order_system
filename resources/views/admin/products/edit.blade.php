@extends('admin.layouts.master')
@section('title', 'Product Edit Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-2 offset-1">
                    <a href="{{route('product#list')}}">
                        <button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i></button>
                    </a>

                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Pizza</h3>
                            </div>
                            <hr>

                            <form action="{{route('product#update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="form-group">
                                            <label for="" class="control-label">Pizza Image</label>
                                            <img src="{{asset('storage/'.$pizza->image)}}" alt="">
                                            <div class="mt-3">
                                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid mb-1 @enderror" id="">
                                                @error('pizzaImage')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                        </div>


                                        <div class="mt-3">

                                            <button type="submit" class="btn btn-dark w-100"><i class="fa-solid fa-floppy-disk me-2 "></i>Save</button>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">


                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Name</label>
                                                <input id="cc-pament" name="pizzaName" type="text" value='{{old('pizzaName',$pizza->name)}}'
                                                    class="form-control @error('pizzaName') is-invalid mb-1 @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Pizza Name...">
                                                @error('pizzaName')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Price</label>
                                                <input id="cc-pament" name="pizzaPrice" type="number" value='{{old('pizzaPrice',$pizza->price)}}'
                                                    class="form-control @error('pizzaPrice') is-invalid mb-1 @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Price...">
                                                @error('pizzaPrice')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Waiting Time (mins)</label>
                                                <input id="cc-pament" name="pizzaWaitingTime" type="number" value='{{old('pizzaWaitingTime',$pizza->waiting_time)}}'
                                                    class="form-control @error('pizzaWaitingTime') is-invalid mb-1 @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Waiting Time...">
                                                @error('pizzaWaitingTime')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Category</label>
                                                <select name="pizzaCategory" id="" class="form-control" >
                                                    <option value="">Choose Category...</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}" @if ($pizza->category_id == $category->id) selected @endif >{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label ">Description</label>
                                                <textarea name="pizzaDescription" id="" cols="10" rows="5" class="form-control @error('pizzaDescription') is-invalid mb-1 @enderror"
                                                    placeholder="Enter Description...">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                                @error('pizzaDescription')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">View Count</label>
                                                <input id="cc-pament" name="viewCount" type="text" value='{{old('viewCount',$pizza->view_count)}}'
                                                    class="form-control"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label">Created At</label>
                                                <input id="cc-pament" name="createdAt" type="text" value='{{old('viewCount',$pizza->created_at->format('F j, Y'))}}'
                                                    class="form-control"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="" disabled>
                                            </div>

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
