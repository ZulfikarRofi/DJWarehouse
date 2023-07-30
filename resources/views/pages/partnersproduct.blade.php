@extends('layout.master')
@section('page', 'Laporan Penjualan')
@section('content')


<div class="container">
    <div class="card p-3">
        <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">Halaman Relasi | Daftar Supplier Produk {{$getP}}</h5>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>ID Supplier</th>
                            <th>Asal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($y as $yy)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$yy['partner_name']}}</td>
                            <td>{{$yy['partner_id']}}</td>
                            <td>{{$yy['address']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection