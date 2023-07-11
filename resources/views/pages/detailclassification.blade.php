@extends('layout.master')
@section('page', 'Product Dashboard')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Product Page | Halaman Tabel Produk Toko UD. Dewa Jaya</h5>
        </div>
        <p class="fw-semibold text-black">Hasil Klasifikasi Produk Pada Gudang Periode <span class="passive-text fw-semibold text-primary">{{$formatAwal}}</span> s/d <span class="passive-text fw-semibold text-primary">{{$formatAkhir}}</span></p>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Nomor Produk</th>
                    <th class="text-center">Nilai Presentase</th>
                    <th class="text-center">Nilai Presentase Kumulatif</th>
                    <th class="text-center">Kategori Kelas</th>
                </tr>
            </thead>
            <tbody>
                @php($a = 1)
                @php($i = 0)
                @foreach($finalKl as $fk)
                <tr>
                    <td>{{$a++}}</td>
                    <td>{{$fk['product_name']}}</td>
                    <td>{{$fk['product_id']}}</td>
                    <td>{{round($fk['precentage'], 1)}} %</td>
                    <td>{{round($fk['kumulatif'], 1)}} %</td>
                    <td>{{$fk['class']}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
