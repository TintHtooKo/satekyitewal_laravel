@extends('admin.layout.master')
@section('content')

    <div class="container">
        <div class="my-4 h4 fw-bold text-center text-dark">All Product List</div>
        <div class="d-flex justify-content-between mx-5 px-5">
            <div class="my-3">
                <a href="{{route('createProduct')}}" class=" btn btn-sm rounded shadow-md bg-primary text-white"><i class="fa fa-plus"></i></a>
            </div>
            <div class=" my-3">
                <form action="{{route('productList')}}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" value="{{request('search')}}" class=" form-control" placeholder="Search ...">
                        <button class="btn bg-dark text-white" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mx-5 px-5 mb-2">
            <button class="btn btn-secondary rounded shadow-sm"><i class="fa fa-filter"></i> Total Products - {{$product->count()}}</button>
            <a href="{{route('productList')}}" class="btn btn-outline-primary rounded shadow-sm">All Products</a>
            <a href="{{route('productList','lowAmt')}}" class="btn btn-outline-danger rounded shadow-sm">Low Stock Products</a>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-hover shadow-sm">
                    <thead class=" bg-primary text-white">
                      <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Category</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($product) > 0)
                        @foreach ($product as $item)
                        <tr>
                            <td class="col-1"><img src="{{asset('product/'.$item->image)}}" class="w-100 img-thumbnail shadow-sm rounded" alt=""></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}} Ks</td>
                            <td>
                                <button class="btn btn-secondary position-relative">
                                    {{$item->stock}}
                                    @if ($item->stock <= 3)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            Low Stock
                                        </span>
                                    @endif
                                </button>
                            </td>
                            <td>{{$item->category_name}}</td>
                            <td>
                                <a href="{{ route('detailProduct', $item->id)}}" class=" btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('updateProductPage', $item->id)}}" class=" btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('deleteProduct', $item->id)}}" class=" btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                        @else
                        <tr>
                            <td colspan="7"><h5 class="text-muted text-center">There is no data ...</h5></td>
                        </tr>
                        @endif
                    </tbody>
                  </table>

                  {{-- Pagination --}}
                  {{-- <span class="d-flex justify-content-end">{{$users->links()}}</span> --}}
            </div>
        </div>
    </div>

@endsection