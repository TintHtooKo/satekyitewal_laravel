@extends('admin.layout.master')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">


            <div class="">
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="card">
                            <div class="card-body shadow">
                                <form action="{{route('changePassword')}}" method="post" class="p-3">
                                    @csrf
                                  <div class="mb-3">
                                    <label class="form-label">Old Password</label>
                                    <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Enter Old Password">
                                    @error('oldPassword')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                  </div>

                                  <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter New Password">
                                    @error('newPassword')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                  </div>

                                  <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Enter Confirm Password">
                                    @error('confirmPassword')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                  </div>

                                  <div>
                                    <input type="submit" class="btn btn-dark text-white" value="Change Password">
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection