@extends('layout.master')
@section('page', 'Add New Transaction')
@section('content')

<div class="card p-2">
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        Oops! some input is wrong
        @foreach($errors->all() as $error)
        <li class="text-red-500 list-none">
            {{ $error }}
        </li>
        @endforeach
    </div>
    @endif
    <div class="card-body">
        <h5 class="card-title">Add New Transaction</h5>
        <form action="/createtransaction" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-8">
                    <label for="" class="col-form-label">Product</label>
                    <select name="product_id" id="product_id" class="form-select">
                        <option selected value="">Select Product</option>
                        @foreach($product as $value)
                        <option value="{{$value->id}}">{{$value->med_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="" class="col-form-label">Transaction Date</label>
                    <input type="date" class="form-select" id="transaction_date" name="transaction_date">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="col-form-label">Buying</label>
                    <input type="number" class="form-control" id="buy" name="buy">
                </div>
                <div class="col-6">
                    <label for="" class="col-form-label">Selling</label>
                    <input type="number" class="form-control" id="sell" name="sell">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="" class="col-form-label">First Balance</label>
                    <input type="number" class="form-control" id="first_balance" name="first_balance">
                </div>
                <div class="col-4">
                    <label for="" class="col-form-label">Last Balance</label>
                    <input type="number" class="form-control" id="last_balance" name="last_balance">
                </div>
                <div class="col-4">
                    <label for="" class="col-form-label">Total Adjustment</label>
                    <input type="number" class="form-control" id="total_adjust" name="total_adjust">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
