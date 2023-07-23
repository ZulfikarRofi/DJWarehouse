@extends('layout.master')
@section('page', 'Daftar Log Perpindahan Barang')
@section('content')

<div class="card px-2">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Halaman Laporan</span> | Daftar Log Perpindahan Produk</h5>
            <div class="filter pt-2">
                <a class="icon fs-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Menu Laporan</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Cetak Laporan</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama Produk</th>
                    <th scope="col" class="text-center">Warna Produk</th>
                    <th scope="col" class="text-center">Nomor Produk</th>
                    <th scope="col" class="text-center">Lokasi Awal</th>
                    <th scope="col" class="text-center">Lokasi Akhir</th>
                    <th scope="col" class="text-center">Tanggal Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportLog as $rL)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">{{$rL['product_name']}}</td>
                    <td class="text-center">{{$rL['product_color']}}</td>
                    <td class="text-center">{{$rL['product_number']}}</td>
                    <td class="text-center">
                        @if($rL['old_rack'] == 'null')
                        <span class="text-black">Belum Tersedia</span>
                        @else
                        {{$rL['old_rack']}}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(empty($rL['new_rack']))
                        <span class="text-black">Belum Tersedia</span>
                        @elseif($rL['new_rack'] == 'null')
                        <span class="text-black">Belum Tersedia</span>
                        @else
                        {{$rL['new_rack']}}
                        @endif
                    </td>
                    <td class="text-center">{{$rL['change_on']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>


@endsection
