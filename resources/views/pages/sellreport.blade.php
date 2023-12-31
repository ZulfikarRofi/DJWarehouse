@extends('layout.master')
@section('page', 'Laporan Penjualan')
@section('content')


<div class="container">
    <div class="card p-3">
        <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">Halaman laporan | Laporan Penjualan Produk</h5>
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
                <!-- Bordered Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col" class="text-center">Nama Produk</th>
                            <th scope="col" class="text-center">Warna</th>
                            <th scope="col" class="text-center">Nomor Produk</th>
                            <th scope="col" class="text-center">Harga/Unit</th>
                            <th scope="col" class="text-center">Total Terjual</th>
                            <th scope="col" class="text-center">Pendapatan/Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $a = 1;
                        $totaljual = 0;
                        $totalpendapatan = 0;
                        @endphp
                        @foreach($totalPP as $tpp)
                        @php
                        $totaljual += $tpp->total_jual;
                        $totalpendapatan += $tpp->totalpp;
                        @endphp
                        <tr>
                            <td class="text-center">{{$a++}}</td>
                            <td class="text-center">{{$tpp->name}}</td>
                            <td class="text-center">{{$tpp->colors}}</td>
                            <td class="text-center">{{$tpp->product_number}}</td>
                            <td class="text-center">Rp. {{number_format($tpp->sell_price, 0 , ',' , '.')}},-</td>
                            <td class="text-center">{{$tpp->total_jual}} Pcs</td>
                            <td class="text-center">Rp. {{number_format($tpp->totalpp, 0 , ',' , '.')}},-</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5"></th>
                            <th class="text-center fw-bold">{{$totaljual}} Pcs</th>
                            <th class="text-center fw-bold">Rp. {{number_format($totalpendapatan, 0 , ',' , '.')}},-</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
