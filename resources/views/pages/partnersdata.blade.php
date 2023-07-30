@extends('layout.master')
@section('page', 'Product Dashboard')
@section('content')

<div class="card">
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
            <h5 class="card-title">Halaman Relasi | Halaman Tabel Relasi</h5>
            <div class="d-flex justify-content-end">
                <div class="search-bar mt-3 px-2">
                    <form class="search-form d-flex align-items-center" method="POST" action="#">
                        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div><!-- End Search Bar -->
            </div>
        </div>
    </div>
    <div class="card-body mb-3">
        <!-- Bordered Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-center" style="width:10%">Nama</th>
                    <th scope="col" class="text-center" style="width:10%">ID Partner</th>
                    <th scope="col" class="text-center" style="width:10%">Tipe</th>
                    <th scope="col" class="text-center" style="width:10%">Alamat</th>
                    <th scope="col" class="text-center" style="width:10%">Nomor Telepon</th>
                    <th scope="col" class="text-center" style="width:10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($part as $value)
                <tr>
                    <td class="text-center" style="width:5%;">{{$loop->iteration}}</td>
                    <td class="text-center" style="width:25%;">{{$value->partners_name}}</td>
                    <td class="text-center" style="width:20%;">{{$value->partners_ID}}</td>
                    <td class="text-center" style="width:20%;">{{$value->type}}</td>
                    <td class="text-center" style="width:20%;">{{$value->address}}</td>
                    <td class="text-center" style="width:10%;">{{$value->phone_number}}</td>
                    <td class="text-center">
                        <div class="filter">
                            <a class="icon fs-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Menu Relasi</h6>
                                </li>

                                <li><a class="dropdown-item" href="/productspartner/{{$value->id}}">Cek Produk Supplier</a></li>
                                <li><a class="dropdown-item" href="/transactionspartner/{{$value->id}}">Cek Transaksi Supplier</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End Bordered Table -->
    </div>
</div>
</div>
@endsection