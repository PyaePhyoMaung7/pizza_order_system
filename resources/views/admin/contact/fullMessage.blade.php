@extends('admin.layouts.master')
@section('title', 'Contact Message Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="">
                    <div class="col-lg-2 offset-2">
                        <button class="btn bg-dark text-white my-3" onclick = "history.back()"><i class="fa-solid fa-arrow-left"></i></button>
                    </div>

                    <div class="col-7 offset-2">
                        <div class="card mb-3">
                            <div class="card-header">

                                <h4><i class="fa-solid fa-envelope-open me-2"></i>Message Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-4"><i class="fa-solid fa-user me-2"></i> Customer </div>
                                    <div class="col">{{strtoupper($fullMessage->name)}}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-4"><i class="fa-solid fa-envelope me-2"></i> Email</div>
                                    <div class="col">{{$fullMessage->email}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4"><i class="fa-solid fa-clock me-2"></i> Date</div>
                                    <div class="col">{{strtoupper($fullMessage->created_at->format('F j, Y'))}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5 mb-2"><i class="fa-solid fa-file-contract me-2 fs-5"></i> <span class="border-bottom border-dark ">Message</span> </div>
                                    <div class="col-12">{{$fullMessage->message}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection



