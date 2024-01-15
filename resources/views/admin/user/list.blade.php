@extends('admin.layouts.master')
@section('title', 'User List Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    @if(session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark me-2"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('updateSuccess'))
                        <div class="col-6 offset-6">
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

                        <div class="col-3 btn bg-white shadow-sm px-3">
                            <h4>Total results <i class="fa-solid fa-database mx-2"></i><span id="resultCount">{{$users->total()}}</span></h4>
                        </div>


                        <div class="col-3 offset-2">
                            <form action="{{route('user#list')}}" method="GET" class="d-flex">
                                @csrf
                                <input type="text" id="searchKey" name="searchKey" class="form-control me-3" id="" value="{{request('searchKey')}}" placeholder="Search...">
                                <button class="btn btn-dark" id="searchBtn" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if (count($users) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center"
                                style="border-collapse: separate; border-spacing: 0px 5px">
                                <thead>
                                    <tr class="" >
                                        <th class="fs-6">Image</th>
                                        <th class="fs-6">Name</th>
                                        <th class="fs-6">Email</th>
                                        <th class="fs-6">Gender</th>
                                        <th class="fs-6">Phone</th>
                                        <th class="fs-6">Address</th>
                                        <th class="fs-6">Role</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle">
                                                @if ($user->image == null)
                                                    @if ($user->gender == 'male')
                                                        <img src="{{ asset('image/default_male.jpg') }}" alt="">
                                                    @else
                                                        <img src="{{ asset('image/default_female.webp') }}" alt="">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $user->image) }}"
                                                        alt="{{ $user->name }}" />
                                                @endif
                                            </td>
                                            <td class="">{{$user->name}}</td>
                                            <input type="hidden" name="" class="userId" value="{{$user->id}}">
                                            <td class="">{{$user->email}}</td>
                                            <td class="">{{$user->gender}}</td>
                                            <td class="">{{$user->phone}}</td>
                                            <td class="">{{$user->address}}</td>
                                            <td class="col-3">
                                                <div class="table-data-feature flex-column">
                                                    <select name="" id="" class="form-control statusChange mb-2 rounded-3 shadow-sm">
                                                        <option value="user" @if($user->role == 'user')selected @endif>User</option>
                                                        <option value="admin" @if($user->role == 'admin')selected @endif>Admin</option>
                                                    </select>

                                                    <a href="{{ route('user#delete', $user->id) }}">
                                                        <button class="item " data-toggle="tooltip"
                                                            data-placement="right" title="Delete">
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
                                {{$users->links()}}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no User Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $userId = $parentNode.find('.userId').val();

            $.ajax({
                type: 'get',
                url: '/user/change/role',
                data: {
                    'role':$currentStatus,
                    'userId':$userId,
                },
                dataType: 'json'
            });

            location.reload();
        })
    })



</script>
@endsection


