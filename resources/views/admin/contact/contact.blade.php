@extends('admin.layouts.master')
@section('title', 'Contact Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Messages</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <button class="btn btn-dark au-btn au-btn-icon au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>



                    @if(session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark me-2"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif



                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-dark">{{request('searchKey')}}</span> </h4>
                        </div>

                        <div class="col-3 btn bg-white shadow-sm px-3">
                            <h4>Total results <i class="fa-solid fa-database mx-2"></i><span id="resultCount">{{$messages->total()}}</span></h4>
                        </div>


                        <div class="col-3 offset-2">
                            <form action="{{route('admin#messageList')}}" method="GET" class="d-flex">
                                @csrf
                                <input type="text" id="searchKey" name="searchKey" class="form-control me-3" id="" value="{{request('searchKey')}}" placeholder="Search...">
                                <button class="btn btn-dark" id="searchBtn" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>






                    @if (count($messages) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center"
                                style="border-collapse: separate; border-spacing: 0px 5px">
                                <thead>
                                    <tr class="" >
                                        <th class="fs-6">Name</th>
                                        <th class="fs-6">Email</th>
                                        <th class="fs-6">Message</th>
                                        <th class="fs-6">Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($messages as $message)
                                        <tr class="tr-shadow">
                                            <td class="align-middle">{{ $message->name }}</td>
                                            <td class="">{{ $message->email }}</td>
                                            <td class="">
                                                {{ Str::substr($message->message, 0, 15).'...'}}</a>
                                            </td>
                                            <td class="">{{ $message->created_at->format('F j, Y') }}</td>
                                            <td class="table-data-feature">
                                                <a id="readBtn" class="item me-1" href="{{ route('admin#showFullMessage', $message->id) }}">
                                                    <button class="item " data-toggle="tooltip"
                                                        data-placement="top" title="read">
                                                        <i class="fa-solid fa-book-open"></i>
                                                    </button>
                                                </a>

                                                <a class="item me-1" href="{{ route('admin#deleteMessage', $message->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{$messages->links()}}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Message Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection



