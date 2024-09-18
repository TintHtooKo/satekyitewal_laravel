@extends('admin.layout.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 card p-3 rounded shadow-sm">
                <div class="card-title bg-dark text-white p-3 text-center font-bold h5">Add New User</div>

                <form action="{{route('addNewUser')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                            @error('name')
                                <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" value="{{old('email')}}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                            @error('email')
                                <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
        
        
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                            @error('password')
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
                        <div class="mb-3">
                            <input type="submit" value="Create" class="btn btn-primary w-100 rounded shadow-sm">
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>
        
    </div>

@endsection