@extends('layout.master')
@section('page', 'Laporan Stok Barang')
@section('content')


<div class="container">
    <div class="card p-3">
        <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">Halaman Laporan | Laporan Stok Produk Toko</h5>
                <div class="filter">
                    <a class="icon fs-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Menu Laporan</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Cetak Laporan</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body mb-3">
                <div class="row mb-3">
                    <!-- Active Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center" style="width: 15%;">Gambar Produk</th>
                                <th scope="col" class="text-center">Nama Produk</th>
                                <th scope="col" class="text-center">ID Produk</th>
                                <th scope="col" class="text-center">Stok Gudang</th>
                                <th scope="col" class="text-center">Total Barang Masuk</th>
                                <th scope="col" class="text-center">Total Barang Keluar</th>
                                <th scope="col" class="text-center">Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($a = 1)
                            @foreach($result as $rs)
                            <tr>
                                <td scope="row" class="text-center">{{$a++}}</td>
                                <td class="text-center"><img src="/image/{{$rs['image']}}" alt="" style="width: 100%;"></td>
                                <td class="text-center">{{$rs['name']}}</td>
                                <td class="table-active text-center">{{$rs['product_number']}}</td>
                                <td class="text-center">{{$rs['stock']}} pcs</td>
                                <td class="text-center">{{$rs['total_buy']}} pcs</td>
                                <td class="text-center">{{$rs['total_sell']}} pcs</td>
                                <td class="text-center">{{$rs['stock']}} pcs</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Active Table -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
