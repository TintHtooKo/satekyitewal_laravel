@extends('admin.layout.master')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Payment Update</h1>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-8 offset-2">
                        <a href="{{route('payment')}}" class="btn mb-3 btn-sm bg-dark text-white">Back</a>
                        <div class="card">
                            <div class="card-body shadow">
                                <form action="{{route('paymentUpdate', $payment->id)}}" method="post" class="p-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Payment Account Name</label>
                                        <input type="text" value="{{old('paymentAccName',$payment->account_name)}}" name="paymentAccName" class="form-control @error('paymentAccName') is-invalid @enderror" placeholder="Enter Name">
                                        @error('paymentAccName')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Payment Account Number</label>
                                        <input type="text" value="{{old('paymentAccNo',$payment->account_number)}}" name="paymentAccNo" class="form-control @error('paymentAccNo') is-invalid @enderror" placeholder="Enter Payment Account Number">
                                        @error('paymentAccNo')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Payment Method</label>
                                        <input type="text" value="{{old('paymentMethod',$payment->type)}}" name="paymentAccMethod" class="form-control @error('paymentAccMethod') is-invalid @enderror" placeholder="Enter Payment Method">
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
                </div>
            </div>

        </div>
@endsection