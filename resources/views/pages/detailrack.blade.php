@extends('layout.master')
@section('page', 'Daftar Produk dalam Rak')
@section('content')

<div class="card px-2">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if(session('delete'))
    <div class="alert alert-warning" role="alert">
        {{ session('delete') }}
    </div>
    @endif
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">{{$rack->name}} ({{$rack->rack_id}})</span> | Daftar Produk</h5>
        </div>
        <div class="new-data d-flex justify-content-end px-2 mb-3">
            <img src="/assets/img/plus.png" alt="new data" style="width:3%" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#tambahrakproduk">Tambah Lokasi Produk Pada Gudang</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Warna</th>
                    <th scope="col">Nomor Produk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product as $pd)
                <tr>
                    <td style="width: 10%;">{{$loop->iteration}}</td>
                    <td><img src="/image/{{$pd->image}}" alt="{{$pd->image}}" style="width:30%"></td>
                    <td style="width:20%">{{$pd->name}}</td>
                    <td style="width:20%">{{$pd->colors}}</td>
                    <td style="width:20%">{{$pd->product_number}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Tambah Rak Produk Modal -->
        <div class="modal fade" id="tambahrakproduk" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Rak Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/addProducttoRack/{{$rack->id}}" method="post">
                            @csrf
                            @method('PATCH')
                            <select name="product_id" id="product_id" class="form-select mb-3">
                                <option value="">--- Pilih Produk ---</option>
                                @foreach($products as $value)
                                <option value="{{$value->id}}">{{$value->name}} {{$value->colors}}</option>
                                @endforeach
                            </select>
                            <input type="number" value="{{$rack->id}}" name="rack_id" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- End Tambah Produk dalam Rak Modal-->
    </div>
</div>

@endsection