@extends('layouts.front')
@section('title')
Profile
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top ">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a>
            / <a href="{{url('/profile')}}"> Profile</a>
        </h6>
    </div>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type='file' id="avatarUpload" accept=".png, .jpg, .jpeg" />
                    <label for="avatarUpload"></label>
                </div>
                <div class="avatar-preview">
                    <img class="profile-user-img img-fluid rounded-circle" id="imagePreview"
                        src="{{$user->avatar?asset('assets/uploads/avatar/'.$user->avatar):asset('assets/uploads/avatar/user.png')}}"
                        alt="User profile picture">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="{{url('/profile')}}" class="nav-link">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/change-password')}}" class="nav-link active">Change password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h6>Change PassWord</h6>
                    <hr>
                    <form action="{{url('/update-password')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                        <label class="col-md-4 col-form-label text-md-end me-5" for="">Old Password</label>

                                        <input type="password" name="password" value=""
                                            class="col-md-8 form-control w-50 d-flex justify-content-between"
                                            placeholder="Enter Old Password">
                                        <p class="error">{{ $errors->first('password') }}</p>
                                        <label class="col-md-4 col-form-label text-md-end me-5" for="">New Password</label>

                                        <input type="password" name="newpass" value=""
                                            class="col-md-8 form-control w-50 d-flex justify-content-between"
                                            placeholder="Enter New Password">
                                        <p class="error">{{ $errors->first('newpass') }}</p>
                                        <label class="col-md-4 col-form-label text-md-end me-5" for="">Confirm New Password</label>

                                        <input type="password" name="newpass_confirmation" value=""
                                            class="col-md-8 form-control w-50 d-flex justify-content-between"
                                            placeholder="Confirm New Password">
                                        <p class="error">{{ $errors->first('newpass_confirmation') }}</p>
                                </div>
                                
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection