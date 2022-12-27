@extends('layouts.master')

@section('content')
    @can('user.create')
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2 mr-3">
                    <a type="button" class="btn btn-primary btn-icon-text" href="{{ route('user.create') }}"><i class="ti-plus btn-icon-prepend"></i>Add Vendor
                    </a>
                </div>
            </div>
        </div>
    @endcan
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="card-title">Filters</h4>
                    </div>
                    <div class="">
                        <span class="badge">
                            <a data-toggle="collapse" href="#user" class="text-primary" aria-expanded="false" aria-controls="filter">
                                <i class="fas fa-filter"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <form action="{{ route('user.index') }}" method="GET">
                    <div class="collapse {{ request()->all() ? 'show' : ' ' }}" id="user">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control mb-2 mr-sm-2" name="name"
                                       value="{{ request()->input('name') }}" id="Name" placeholder="Name">
                            </div>
                            <div class="col-md-3">
                                <input type="email" class="form-control mb-2 mr-sm-2" name="email"
                                       value="{{ request()->input('email') }}" id="Email" placeholder="Email">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control mb-2 mr-sm-2" name="phone"
                                       value="{{ request()->input('phone') }}" id="phone" placeholder="920123456789">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="badge badge-outline-primary mr-2" type="submit"><i
                                    class="icon-search"></i></button>
                            <a class="badge badge-outline-primary" href="{{ route('user.index') }}"><i
                                    class="mdi mdi-flask-empty-outline"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="card-title">Vendors</h4>
                        <p class="card-description">
                        </p>
                    </div>
                    <div class="">
                        <p class="text-right"> Total Record {{ $totalUser }}</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{$user->profile_image_url}}" onerror="profileImgError(this);" alt="image"></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                        <span
                                            class="badge badge-outline-primary">{{ ucfirst($user->roles->first()->name) }}</span>
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="text-primary fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
                                            @can('user.edit')
                                                <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i
                                                        class="far fa-edit m-2"> Edit</i>
                                                </a>
                                            @endcan
                                            {{-- <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">
                                                <i class="fa fa-eye m-2" aria-hidden="true"> Show</i>
                                            </a> --}}
                                            @can('user.delete')
                                                <a class="dropdown-item" onclick='swal({
                                                            title: "Are you sure?",
                                                            text: "Your will not be able to recover this imaginary file!",
                                                            type: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonClass: "btn-danger",
                                                            confirmButtonText: "Yes, delete it!",
                                                            closeOnConfirm: false
                                                            },
                                                            function(){
                                                            document.getElementById("delete-job-{{ $user->id }}").submit();
                                                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                                            });' onclick="event.preventDefault();">
                                                    <i class="fas fa-trash-alt m-2"> Delete</i>
                                                </a>
                                            @endcan
                                        </div>
                                        <form id="delete-job-{{ $user->id }}"
                                              action="{{ route('user.destroy', $user->id) }}" method="POST"
                                              style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection
