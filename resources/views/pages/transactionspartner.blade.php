@extends('layout.master')
@section('page', 'Laporan Penjualan')
@section('content')


<div class="container">
    <div class="card p-3">
        <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">Halaman laporan | Daftar Transaksi Supplier {{$getP}}</h5>
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
                            <th>ID Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Catatan</th>
                            <th>Tipe Transaksi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($z as $xx)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$xx['transaction_id']}}</td>
                            <td>{{$xx['transaction_date']}}</td>
                            <td>{{$xx['note']}}</td>
                            <td>
                                @if($xx['type'] == 'buy')
                                <span class="badge bg-primary">Beli</span>
                                @else
                                <span class="badge bg-success">Jual</span>
                                @endif
                            </td>
                            <td>{{$xx['quantity']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection