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
                            <a href="{{url('/profile')}}" class="nav-link active">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/change-password')}}" class="nav-link">Change password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h6>Basic detail</h6>
                    <hr>
                    <form action="{{url('/update-profile')}}" method="post">
                        @csrf
                        <div class="row checkout-form">
                            <div class="col-md-6 mt-3">
                                <label for="">First Name</label>
                                <input type="text" name="fname" value="{{$user->fname}}" class="form-control"
                                    placeholder="Enter First Name">
                                <p class="error">{{ $errors->first('fname') }}</p>

                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Last Name</label>
                                <input type="text" name="lname" value="{{$user->lname}}" class="form-control"
                                    placeholder="Enter Last Name">
                                <p class="error">{{ $errors->first('lname') }}</p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{$user->email}}" class="form-control"
                                    disabled>
                                <p class="error">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" value="{{$user->phone}}" class="form-control"
                                    placeholder="Enter Phone Number">
                                <p class="error">{{ $errors->first('phone') }}</p>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">House Number, Street Name</label>
                                <input type="text" name="address" value="{{$user->address}}" class="form-control"
                                    placeholder="House Number, Street Name">
                                <p class="error">{{ $errors->first('address') }}</p>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Province</label>
                                <select class="form-select" name="province" id="province"
                                    aria-label="Default select example">
                                    @if ($user->province_id)
                                    @foreach ($provinces as $item)
                                    @if ($user->province_id==$item->id)
                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                    @else
                                    <option disable value="">Select province</option>
                                    @foreach ($provinces as $item)

                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <p class="error">{{ $errors->first('province') }}</p>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">District</label>

                                <select class="form-select" name="district" id="district"
                                    aria-label="Default select example">
                                    @if ($user->district_id)
                                    @foreach ($districts as $item)
                                    @if ($user->district_id==$item->id)
                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                                <p class="error">{{ $errors->first('district') }}</p>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Ward</label>
                                <select class="form-select" name="ward" id="ward" aria-label="Default select example">
                                    @if ($user->ward_id)
                                    @foreach ($wards as $item)
                                    @if ($user->ward_id==$item->id)
                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                                <p class="error">{{ $errors->first('ward') }}</p>
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