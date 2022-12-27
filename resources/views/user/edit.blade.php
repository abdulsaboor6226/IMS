@extends('layouts.master')

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <form class="form-sample" action="{{ route('user.update',$user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p class="card-description">
                        Personal edit info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                                <div class="col-sm-9">
                                    <input type="phone" name="phone" placeholder="920123456789" class="form-control" value="{{ old('phone',$user->phone) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Profile Image</label>
                                <div class="col-sm-9">
                                    <input type="file" value="{{ old('profile_image') }}" data-default-file="{{$user->profile_image_url}}"  class="dropify form-control"
                                           name="profile_image">
                                </div>
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a class="btn btn-light" href="{{route('user.index')}}">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@endsection
