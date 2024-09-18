@extends('user.layout.master')

@section('content')

<div class="container-fluid pt-5 row">
    <div class="card shadow mb-4 col" style="margin: 10%">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h3 class="m-0 font-weight-bold text-primary">User Profile Edit</h3>
                </div>
            </div>
        </div>
        <form action="{{route('userEdit')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset(Auth::user()->profile == null ? 'admin/img/undraw_profile.svg' : 'profile/'.Auth::user()->profile) }}" id="output" class="img-profile img-thumbnail" alt="">
                        
                        <input type="file" onchange="loadFile(event)" name="image" class="form-control mt-1 @error('image') is-invalid @enderror" id="">
                        @error('image')
                            <small class="invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{old('name',Auth::user()->name != null ? Auth::user()->name : Auth::user()->nickname)}}" placeholder="Name..." class="form-control @error('name') is-invalid @enderror" id="">
                                    @error('name')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" value="{{old('email',Auth::user()->email)}}" name="email" placeholder="Email..." class="form-control @error('email') is-invalid @enderror" id="">
                                    @error('email')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{old('phone',Auth::user()->phone)}}" placeholder="+959xxxxxxx" class="form-control @error('phone') is-invalid @enderror" id="">
                                    @error('phone')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Address</label>
                                    <input type="text" name="address" value="{{old('address',Auth::user()->address)}}" placeholder="Address..." class="form-control @error('address') is-invalid @enderror" id="">
                                    @error('address')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Update" class="btn mt-3 text-white w-50" style="background-color: #81c408">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection