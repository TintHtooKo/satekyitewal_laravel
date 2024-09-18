@extends('user.layout.master')

@section('content')
    <div class=" container-fluid mt-5 pt-5">
        <div class="mt-5 pt-3 row">
            <div class="col-3 offset-2">
                <img class="img-profile img-thumbnail" src="{{ asset(Auth::user()->profile == null ? 'admin/img/undraw_profile.svg' : 'profile/'.Auth::user()->profile) }}" alt="">
            </div>
            <div class="col offset-1">
                <div class="row mt-3">
                    <div class="col-2 h5">Name : </div>
                    <div class="col h5">{{Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name}}</div>
                </div>

                <div class="row mt-3">
                    <div class="col-2 h5">Email : </div>
                    <div class="col h5">{{Auth::user()->email}}</div>
                </div>

                <div class="row mt-3">
                    <div class="col-2 h5">Phone : </div>
                    <div class="col h5">{{Auth::user()->phone}}</div>
                </div>

                <div class="row mt-3">
                    <div class="col-2 h5">Address : </div>
                    <div class="col h5">{{Auth::user()->address}}</div>
                </div>
                <a href="{{route('userEditPage')}}" class="btn text-white mt-3 rounded shadow-md" style="background-color: #81c408"><i class="fa-solid fa-pen"></i> Edit Profile</a>
            </div>
        </div>
    </div>
@endsection