@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="my-4 h4 fw-bold text-center text-dark">Product Detail</div>
        <div class="row">
            <div class="col-4">
                <img src="{{asset('product/'.$product->image)}}" class=" img-thumbnail" alt="">
            </div>
            <div class="col">
                <div class="row mt-3">
                    <div class="col-2 h6">Name : </div>
                    <div class="col h6">{{$product->name}}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-2 h">Price : </div>
                    <div class="col h6">{{$product->price}} Ks</div>
                </div>
                <div class="row mt-3">
                    <div class="col-2 h">Stock : </div>
                    <div class="col h6">{{$product->stock}}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-2 h6">Category : </div>
                    <div class="col h6">{{$product->category_name}}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-2 h6">Description : </div>
                    <div class="col h6">{{$product->description}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection