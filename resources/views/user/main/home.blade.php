@extends('user.layouts.master')

@section('title', 'User Home Page')

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by
                        Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white mt-3 px-3 py-1">
                            <label class="mt-2" for="">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($categories) }}</span>
                        </div>

                        <div class=" d-flex align-items-center justify-content-between mb-3 pt-1">
                            <a href="{{ route('user#home') }}" class="text-decoration-none text-dark">
                                All
                            </a>

                        </div>

                        <div style="height: 10rem; overflow: auto;">
                            @foreach ($categories as $category)
                                <div class=" d-flex align-items-center justify-content-between mb-3 pt-1">
                                    <a href="{{ route('user#filter', $category->id) }}" class="text-decoration-none text-dark">
                                        {{ $category->name }}
                                    </a>
                                    {{-- <span class="badge border font-weight-normal text-muted">{{ count($categories) }}</span> --}}
                                </div>
                            @endforeach
                        </div>

                    </form>
                </div>


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-dark position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle px-2 bg-warning text-black border-dark rounded-circle">{{ count($cart) }}</span>
                                    </button>
                                </a>

                                <a href="{{ route('user#history') }}" class="ms-2">
                                    <button type="button" class="btn btn-dark position-relative">
                                        <i class="fa-solid fa-clock-rotate-left me-2"></i>History
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle px-2 bg-warning text-black border-dark rounded-circle">{{ count($history) }}</span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">


                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="desc" selected>Newest</option>
                                    <option value="asc">Oldest</option>
                                </select>

                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dataList" class="row">
                    @if (count($pizzas) != 0)
                        @foreach ($pizzas as $pizza)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100 object-fit-cover" style="height: 250px"
                                            src="{{ asset('storage/' . $pizza->image) }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('user#pizzaDetails', $pizza->id) }}"><i class="fa-solid fa-cart-plus"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $pizza->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $pizza->price }} kyats</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center"><i class="fa-solid fa-pizza-slice me-2"></i> There is no product in this
                            category!</h3>
                    @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
    </div>
@endsection

{{-- href="{{ route('user#pizzaDetails',  ${response[$i].id}) }}" --}}

@section('jsSource')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                let eventOption = $('#sortingOption').val();

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/pizzaList',
                    data: {
                        'status': eventOption
                    },
                    dataType: 'json',
                    success: function(response) {
                        $list = '';
                        for ($i = 0; $i < response.length; $i++) {
                            $href = `{{ route('user#pizzaDetails', 'id') }}`.replace('id',response[$i].id);

                            $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden" >
                                <img class="img-fluid w-100 object-fit-cover" style="height: 250px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="${$href}" ><i class="fa-solid fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price}</h5>
                                </div>
                            </div>
                        </div>
                    </div>`;
                        }
                        $('#dataList').html($list);

                        }



                });

            });

        });
    </script>
@endsection
