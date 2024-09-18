
@extends('admin.layout.master')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Payment List</h1>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body shadow">
                                <form action="{{route('paymentCreate')}}" method="post" class="p-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Payment Account Name</label>
                                        <input type="text" value="{{old('paymentAccName')}}" name="paymentAccName" class="form-control @error('paymentAccName') is-invalid @enderror" placeholder="Enter Name">
                                        @error('paymentAccName')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Payment Account Number</label>
                                        <input type="text" value="{{old('paymentAccNo')}}" name="paymentAccNo" class="form-control @error('paymentAccNo') is-invalid @enderror" placeholder="Enter Payment Account Number">
                                        @error('paymentAccNo')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Payment Method</label>
                                        <input type="text" value="{{old('paymentMethod')}}" name="paymentAccMethod" class="form-control @error('paymentAccMethod') is-invalid @enderror" placeholder="Enter Payment Method">
                                        @error('paymentAccMethod')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                                    </div>
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
                                <th scope="col">Payment Method</th>
                                <th scope="col">Created at</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $item)
                                    <tr>
                                        {{-- ($payments->currentPage() - 1) * $payments->perPage()
                                        This part calculates the total number of items that came before the current page. For example:
                                        If you're on page 1, it becomes 0 * 10 = 0 (no previous items).
                                        If you're on page 2, it becomes 1 * 10 = 10 (10 items on the first page).
                                        If you're on page 3, it becomes 2 * 10 = 20 (20 items on the first two pages). --}}
                                        <th scope="row">{{ ($payments->currentPage() - 1) * $payments->perPage() + $loop->iteration }}</th><!-- This will display 1, 2, 3, ... -->
                                        <td>{{$item->account_name}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->created_at->format('d-m-Y H:i')}}</td>
                                        <td>
                                            <a href="{{route('paymentUpdatePage', $item->id)}}" class=" btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{route('paymentDelete', $item->id)}}" class=" btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                          
                        {{-- Pagination --}}
                        <span class="d-flex justify-content-end">{{$payments->links()}}</span>
                    </div>
                </div>
            </div>

        </div>
@endsection
