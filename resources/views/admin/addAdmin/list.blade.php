@extends('admin.layout.master')
@section('content')

    <div class="container">
        <div class="my-4 h4 fw-bold text-center text-dark">All Admins List</div>
        <div class="d-flex justify-content-between mx-5 px-5">
            <div class="my-3">
                <a href="{{route('addNewAdminPage')}}" class=" btn btn-sm rounded shadow-md bg-primary text-white"><i class="fa fa-plus"></i></a>
            </div>
            <div class=" my-3">
                <form action="{{route('adminList')}}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" value="{{request('search')}}" class=" form-control" placeholder="Search ...">
                        <button class="btn bg-dark text-white" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-hover shadow-sm">
                    <thead class=" bg-primary text-white">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created at</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($admin as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration }}</th><!-- This will display 1, 2, 3, ... -->
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td><span class="btn btn-sm bg-warning text-white shadow-sm rounded">{{$item->role}}</span></td>
                            <td>{{$item->created_at->format('d-m-Y H:i')}}</td>
                            <td>
                                @if ($item->role !== 'superadmin')
                                    <a href="{{ route('adminDelete', $item->id)}}" class=" btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection