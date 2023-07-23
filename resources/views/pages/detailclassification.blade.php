@extends('layout.master')
@section('page', 'Product Dashboard')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Halaman Laporan | Hasil Klasifikasi Produk</h5>
        </div>
        <p class="fw-semibold text-black px-3">Hasil Klasifikasi Produk Pada Gudang Periode <span class="passive-text fw-semibold text-primary">{{$formatAwal}}</span> s/d <span class="passive-text fw-semibold text-primary">{{$formatAkhir}}</span></p>
        <div class="mx-2 alert alert-info  alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Panduan Klasifikasi</h4>
            <p class="m-0">Produk dengan kelas A merupakan produk dengan kategori <span class="fw-bold">Fast Moving</span></p>
            <p class="m-0">Produk dengan kelas B merupakan produk dengan kategori <span class="fw-bold">Medium Moving</span></p>
            <p class="m-0">Produk dengan kelas C merupakan produk dengan kategori <span class="fw-bold">Slow Moving</span></p>
            <hr>
            <p class="mb-0">Klasifikasi Produk Ini Menggunakan Metode Klasifikasi ABC Untuk Menentukan Kelas Dari Setiap Produk</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Nomor Produk</th>
                    <th class="text-center">Nilai Presentase</th>
                    <th class="text-center">Nilai Presentase Kumulatif</th>
                    <th class="text-center">Kategori Kelas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($a = 1)
                @php($i = 0)
                @foreach($finalKl as $fk)
                <tr>
                    <td class="text-center">{{$a++}}</td>
                    <td class="text-center">{{$fk['product_name']}}</td>
                    <td class="text-center">{{$fk['product_number']}}</td>
                    <td class="text-center">{{round($fk['precentage'], 1)}} %</td>
                    <td class="text-center">{{round($fk['kumulatif'], 1)}} %</td>
                    <td class="text-center">
                        @if($fk['class'] == 'A')
                        <span class="badge bg-success">{{$fk['class']}}</span>
                        @elseif($fk['class'] == 'B')
                        <span class="badge bg-primary">{{$fk['class']}}</span>
                        @else
                        <span class="badge bg-secondary">{{$fk['class']}}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="filter">
                            <a class="icon fs-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Menu Klasifikasi</h6>
                                </li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detail{{$fk['product_id']}}">Lihat Detail Klasifikasi</a></li>
                            </ul>
                        </div>
                        <div class="modal fade" id="detail{{$fk['product_id']}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Proses Klasifikasi Produk <span class="text-black fw-bold">{{$fk['product_name']}}</span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        Presentase Diperoleh dari penjumlahan sebagai berikut: <br>
                                        <span class="text-black fw-bold">{{round($fk['precentage'], 3)}} %</span> (Hasil Presentase) = <span class="text-black fw-bold">{{number_format($fk['totalpp'], 0 , ',' , '.')}}</span>(Total Penjualan Per Produk) / <span class="text-black fw-bold">{{number_format($fk['totalsp'], 0 , ',' , '.')}}</span>(Total Penjualan Semua Produk)
                                    </div>
                                    <div class="modal-footer">
                                        <div class="mx-2 alert alert-warning  alert-dismissible fade show" role="alert">
                                            @if($fk['class'] == 'A')
                                            Produk ini memiliki jumlah transaksi penjualan yang tergolong <span class="fw-bold">banyak</span>, sehingga barang banyak keluar gudang dan direkomendasikan diarahkan ke lokasi <span class="fw-bold">terdepan</span> dari gudang.
                                            @elseif($fk['class'] == 'B')
                                            Produk ini memiliki jumlah transaksi penjualan yang tergolong <span class="fw-bold">menengah</span>, sehingga barang dengan jumlah yang cukup keluar gudang dan direkomendasikan diarahkan ke lokasi <span class="fw-bold">tengah</span> dari gudang.
                                            @else
                                            Produk ini memiliki jumlah transaksi penjualan yang tergolong <span class="fw-bold">sedikit</span>, sehingga barang dengan jumlah yang cukup keluar gudang dan direkomendasikan diarahkan ke lokasi <span class="fw-bold">belakang</span> dari gudang.
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Vertically centered Modal-->
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
