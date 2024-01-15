@extends('admin.layouts.master')
@section('title', 'Admin List Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->


                    @if (session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span
                                    class="text-dark">{{ request('searchKey') }}</span> </h4>
                        </div>

                        <div class="col-3 btn bg-white shadow-sm px-3 ">
                            <h4>Total results <i class="fa-solid fa-database mx-2"></i> {{ $admins->total() }}</h4>
                        </div>

                        <div class="col-3 offset-3">
                            <form action="{{ route('admin#list') }}" method="GET" class="d-flex">
                                @csrf
                                <input type="text" name="searchKey" class="form-control me-2" id=""
                                    value="{{ request('searchKey') }}" placeholder="Search...">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (count($admins) != 0)
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center"
                                style="border-collapse: separate; border-spacing: 0px 5px">
                                <thead class="">
                                    <tr class="">
                                        <th class="fs-6">Image</th>
                                        <th class="fs-6">Name</th>
                                        <th class="fs-6">Email</th>
                                        <th class="fs-6">Gender</th>
                                        <th class="fs-6">Phone</th>
                                        <th class="fs-6">Address</th>
                                        @if (Auth::user()->role == 'super_admin')
                                            <th class="fs-6">Role</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr class="tr-shadow">
                                            <td class="align-middle col-1">
                                                @if ($admin->image == null)
                                                    @if ($admin->gender == 'male')
                                                        <img src="{{ asset('image/default_male.jpg') }}" alt="">
                                                    @else
                                                        <img src="{{ asset('image/default_female.webp') }}" alt="">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $admin->image) }}"
                                                        alt="{{ $admin->name }}" />
                                                @endif
                                            </td>
                                            <td class="">{{ $admin->name }}</td>
                                            <td class="">{{ $admin->email }}</td>
                                            <td class="">{{ $admin->gender }}</td>
                                            <td class="">{{ $admin->phone }}</td>
                                            <td class="">{{ $admin->address }}</td>


                                            @if (Auth::user()->role == 'super_admin')
                                                <td class="col-3">
                                                    <div class="table-data-feature flex-column">
                                                        @if (Auth::user()->id == $admin->id)
                                                        @else
                                                            <input type="hidden" class="adminId" name=""
                                                                value="{{ $admin->id }}">

                                                            <select name="" id=""
                                                                class="form-control statusChange mb-2 rounded-3 shadow-sm">
                                                                <option value="admin"
                                                                    @if ($admin->role == 'admin') selected @endif>Admin
                                                                </option>
                                                                <option value="user"
                                                                    @if ($admin->role == 'user') selected @endif>User
                                                                </option>

                                                            </select>

                                                            <a href="{{ route('admin#delete', $admin->id) }}">
                                                                <button class="item " data-toggle="tooltip"
                                                                    data-placement="right" title="Delete">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $admins->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Admin Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $adminId = $parentNode.find('.adminId').val();

                $.ajax({
                    type: 'get',
                    url: '/admin/change/role',
                    data: {
                        'adminId': $adminId,
                        'role': $currentStatus,
                    },
                    dataType: 'json',

                });

                location.reload();


            })
        })
    </script>
@endsection
