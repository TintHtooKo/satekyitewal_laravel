@extends('admin.layout.master')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Category Update</h1>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-4 offset-2">
                        <a href="{{route('categoryList')}}" class="btn mb-3 btn-sm bg-dark text-white">Back</a>
                        <div class="card">
                            <div class="card-body shadow">
                                <form action="{{route('categoryUpdate', $category->id)}}" method="post" class="p-3">
                                    @csrf
                                    <input type="text" name="categoryName" value="{{$category->name}}" class="form-control @error('categoryName') is-invalid @enderror" placeholder="Enter Category">
                                    @error('categoryName')
                                        <small class=" invalid-feedback">{{$message}}</small>
                                    @enderror
                                    <input type="submit" value="Update" class="btn btn-outline-primary mt-3">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection