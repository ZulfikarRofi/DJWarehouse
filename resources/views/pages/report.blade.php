@extends('layout.master')
@section('page', 'Report Dashboard')
@section('content')

<div class="card px-2">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Halaman Laporan | Halaman Tabel Produk Toko UD. Dewa Jaya</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mb-2">
                <p class="fw-bold">Laporan Permintaan & Klasifikasi Produk</p>
                <button class="btn btn-primary"><i class="bi bi-printer"></i> Cetak</button>
            </div>
            <!-- Active Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center fw-semibold" scope="col">#</th>
                        <th class="text-center fw-semibold" scope="col">Nama Produk</th>
                        <th class="text-center fw-semibold" scope="col">Warna</th>
                        <th class="text-center fw-semibold" scope="col">ID Produk</th>
                        <th class="text-center fw-semibold" scope="col">Harga(/Unit)</th>
                        <th class="text-center fw-semibold" scope="col">Permintaan(/Tahun)</th>
                        <th class="text-center fw-semibold" scope="col">Total Pendapatan(/Tahun)</th>
                        <th class="text-center fw-semibold" scope="col">Nilai Presentase</th>
                        <th class="text-center fw-semibold" scope="col">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($result as $r)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td class="text-center">{{$r->name}}</td>
                        <td class="text-center">{{$r->colors}}</td>
                        <td class="table-active text-center">{{$r->product_id}}</td>
                        <td class="text-center">Rp. {{$r->sell_price}},-</td>
                        <td></td>
                        <td></td>
                        <td class="text-center">13.68%</td>
                        <td class="text-center"><span class="badge bg-success">A</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Active Table -->
        </div>
    </div>
</div>

@endsection