@extends('admin.layouts.master')
@section('title', 'Category List Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="btn btn-dark au-btn au-btn-icon au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="btn btn-dark au-btn au-btn-icon  au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>



                    @if(session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('updateSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{session('updateSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif



                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-dark">{{request('searchKey')}}</span> </h4>
                        </div>

                        <div class="col-3 btn bg-white shadow-sm px-3 ">
                            <h4>Total results <i class="fa-solid fa-database mx-2"></i> {{$categories->total()}}</h4>
                        </div>

                        <div class="col-3 offset-2">
                            <form action="{{route('category#list')}}" method="GET" class="d-flex">
                                @csrf
                                <input type="text" name="searchKey" class="form-control me-3" id="" value="{{request('searchKey')}}" placeholder="Search...">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center"
                                style="border-collapse: separate; border-spacing: 0px 5px">
                                <thead class="">
                                    <tr class="">
                                        <th class="fs-6">ID</th>
                                        <th class="fs-6">Category Name</th>
                                        <th class="fs-6">Created Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td class="align-middle">{{ $category->id }}</td>
                                            <td class="col-6">{{ $category->name }}</td>
                                            <td class="">{{ $category->created_at->format('F j, Y') }}</td>
                                            <td class="">
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button> --}}
                                                    <a href="{{route('category#edit',[$category->id])}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{route('category#delete',[$category->id])}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{$categories->links()}}
                                {{-- {{$categories->appends(request()->query())->links()}} --}}
                            </div>


                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Category Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection
