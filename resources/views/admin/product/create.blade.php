@extends('admin.layout.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 card p-3 rounded shadow-sm">
                <div class="card-title bg-dark text-white p-3 text-center font-bold h5">Add New Product</div>

                <form action="{{route('createProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="card-body">
                        <div class="mb-3">
                            <img id="output" src="{{asset('master/demo.jpg')}}" class="img-profile img-thumbnail" alt="">
                            
                            <input type="file" onchange="loadFile(event)" name="image" class="form-control mt-1 @error('image') is-invalid @enderror" id="">
                            @error('image')
                                <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text"   value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                                    @error('name')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Category Name</label>
                                    <select name="categoryId" class="form-control @error('category') is-invalid @enderror" id="">
                                        <option value="">Choose Category ...</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}" @if (old('categoryId') == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
        
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" value="{{old('price')}}" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price">
                                    @error('price')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="text" value="{{old('stock')}}" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Enter stock">
                                    @error('stock')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>      
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" placeholder="Enter description" class="form-control @error('description') is-invalid @enderror"  id="" cols="30" rows="10">{{old('description')}}</textarea>
                            @error('description')
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