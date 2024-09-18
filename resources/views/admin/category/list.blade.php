@extends('admin.layout.master')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Category List</h1>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body shadow">
                                <form action="{{route('categoryCreate')}}" method="post" class="p-3">
                                    @csrf
                                    <input type="text" name="categoryName"  class="form-control @error('categoryName') is-invalid @enderror" placeholder="Enter Category">
                                    @error('categoryName')
                                        <small class=" invalid-feedback">{{$message}}</small>
                                    @enderror
                                    <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <table class="table table-hover shadow-sm">
                            <thead class=" bg-primary text-white">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created at</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $item)
                                        <tr>
                                            <th scope="row">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</th><!-- This will display 1, 2, 3, ... -->
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->created_at->format('j-F-Y')}}</td>
                                            <td>
                                                <a href="{{ route('categoryUpdatePage', $item->id)}}" class=" btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('categoryDelete', $item->id)}}" class=" btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"><h5 class="text-muted text-center">There is no data ...</h5></td>
                                    </tr>
                                @endif
                            </tbody>
                          </table>
                          
                        {{-- Pagination --}}
                        <span class="d-flex justify-content-end">{{$categories->links()}}</span>
                    </div>
                </div>
            </div>

        </div>
@endsection