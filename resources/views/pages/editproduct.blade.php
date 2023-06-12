@extends('/layout/master')
@section('page', 'Add New Data')
@section('content')

<div class="card p-2">
    <div class="card-body">
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
        <h5 class="card-title">Add New Data</h5>
        <form action="/editproduct/{{$model->id}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row mb-3 px-3">
                <div class="col-7">
                    <label for="" class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" id="med_name" name="med_name" placeholder="Product Name" value="{{$model->med_name}}">
                </div>
                <div class="col-5">
                    <label for="" class="col-form-label">Product ID</label>
                    <input type="number" name="med_id" id="med_id" class="form-control" value="{{$model->med_id}}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="" class="col-form-label">Farmation</label>
                    <input type="text" class="form-control" id="farmation" name="farmation" placeholder="Farmation Name" value="{{$model->farmation}}">
                </div>
                <div class="col-4">
                    <label for="" class="col-form-label">Class</label>
                    <input type="text" class="form-control" name="class" id="class" placeholder="Class Name" value="{{$model->class}}">
                </div>
                <div class="col-4">
                    <label for="" class="col-form-label">Unit</label>
                    <select name="unit" id="unit" class="form-select">
                        <option selected value="{{$model->unit}}">{{$model->unit}}</option>
                        <option value="ampuls">Ampuls</option>
                        <option value="fls">FLS</option>
                        <option value="pcs">Pcs</option>
                        <option value="vial">Vial</option>
                        <option value="tablet">Tablet</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="col-form-label">Selling Price</label>
                    <input type="number" name="sell_price" id="sell_price" class="form-control" placeholder="" value="{{$model->sell_price}}">
                </div>
                <div class="col-6">
                    <label for="" class="col-form-label">Buying Price</label>
                    <input type="number" name="buy_price" id="buy_price" class="form-control" placeholder="" value="{{$model->buy_price}}">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
