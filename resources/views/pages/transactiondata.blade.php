@extends('layout.master')
@section('page', 'Product Transaction Data')
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
            <h5 class="card-title">Product Page | Halaman Tabel Produk Toko UD. Dewa Jaya</h5>
            <div class="d-flex justify-content-end">
                <div class="search-bar mt-3 px-2">
                    <form class="search-form d-flex align-items-center" method="POST" action="#">
                        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div><!-- End Search Bar -->
            </div>
        </div>
        <div class="new-data d-flex justify-content-end px-2 mb-3">
            <img src="/assets/img/plus.png" alt="new data" style="width:3%" data-bs-toggle="modal" data-bs-target="#createtransaction">
            <!-- New Transaction Form Modal -->
            <div class="modal fade" id="createtransaction" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Transaksi Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Vertical Form -->
                            <form class="row g-3" action="/createtransaction" method="post">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Produk</label>
                                    <select name="product_id" class="form-select" id="product_id">
                                        <option value="" selected>--- Pilih Produk ---</option>
                                        @foreach($product as $value)
                                        <option value="{{$value->id}}">{{$value->name}} {{$value->colors}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Jenis Transaksi</label>
                                    <select name="type" id="typee" class="form-select">
                                        <option value="" selected>--- Jenis Transaksi ---</option>
                                        <option value="buy">Pembelian</option>
                                        <option value="sell">Penjualan</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="note" name="note" placeholder="catatan">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="inputEmail4" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="transaction_date" name="transaction_date">
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12">
                                            <label for="inputEmail4" class="form-label">Kuantitas</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Jumlah barang masuk">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form><!-- New Transaction Form -->
                        </div>
                    </div>
                </div>
            </div><!-- End Vertically centered Modal-->
        </div>
    </div>
    <table class="table" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col" style="width:5%;">#</th>
                <th scope="col" style="width:20%;">Nama Produk</th>
                <th scope="col" style="width:10%;">ID Produk</th>
                <th scope="col" style="width:15%;">ID Transaksi</th>
                <th scope="col" style="width:10%;">Tipe Transaksi</th>
                <th scope="col" style="width:10%;">Kuantitas</th>
                <th scope="col" style="width:10%;">Tanggal Transaksi</th>
                <th scope="col" style="width:10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @forelse($transaction as $value)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$value->name}} {{$value->colors}}</td>
                <td>
                    {{$value->id}}
                    <!-- {{$value->product_id}} -->
                </td>
                <td>{{$value->transaction_id}}</td>
                <td>
                    @if($value->type == 'buy')
                    <span class="badge bg-primary">Beli</span>
                    @else
                    <span class="badge bg-success">Jual</span>
                    @endif
                </td>
                <td>{{$value->quantity}}</td>
                <td>{{$value->transaction_date}}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <img src="/assets/img/edit.png" alt="edit" style="width:25%">
                        <img class="ms-2" src="/assets/img/delete.png" alt="edit" style="width:25%" data-bs-toggle="modal" data-bs-target="#delete-{{$value->id}}">
                        <!-- Delete Product Modal -->
                        <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Data Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus produk ini <span class="fw-bold">"{{$value->transaction_id}}"</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="/deletetransaction/{{$value->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Delete Product Modal-->
                    </div>
                </td>
            </tr>
            @empty
            <div class="row">
                <div class="d-flex justify-content-center">
                    <img src="assets/img/no-entry-data.png" alt="Empty" style="width: 50%;">
                </div>
            </div>
            @endforelse
        </tbody>
    </table>
    <!-- End Active Table -->
</div>

@endsection
