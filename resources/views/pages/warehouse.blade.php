@extends('layout.master')
@section('page', 'Manajemen Gudang')
@section('content')

<div class="card px-2">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Menu Gudang | Halaman Tabel Produk Pada Gudang Toko UD. Dewa Jaya</h5>
            <div class="d-flex justify-content-end align-items-center">
                <div class="filter">
                    <a class="icon fs-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Menu Gudang</h6>
                        </li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#klasifikasiProduk">Klasifikasi Produk</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="new-data d-flex justify-content-end px-2 mb-3">
            <img src="/assets/img/plus.png" alt="new data" style="width:3%" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahgudang">Tambah Gudang</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahkategori">Tambah Kategori</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahlokasi">Tambah Lokasi</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahrak">Tambah Rak</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#tambahrakproduk">Tambah Lokasi Produk Pada Gudang</a></li>
                <li><a class="dropdown-item" href="#">Rubah Lokasi Rak Produk</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body mt-3">
        <div class="row mb-3">
            <div class="col-8">
                <!-- Active Table -->
                <p class="fw-bold">Daftar Rak</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Gudang</th>
                            <th scope="col">Kapasitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($rack as $value)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td class="text-center">{{$value->name}}</td>
                            <td class="table-active text-center">{{$value->rack_id}}</td>
                            <td class="text-center" style="text-transform: capitalize;">
                                {{$value->location_name}}
                            </td>
                            <td class="text-center">
                                {{$value->category_name}}
                            </td>
                            <td class="text-center">{{$value->warehouse_name}}</td>
                            <td class="text-center">{{$value->capacity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Active Table -->
            </div>
            <div class="col-4">
                <p class="fw-bold">Daftar Gudang</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">ID Gudang</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($wh as $value)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td class="text-center">{{$value->warehouse_name}}</td>
                            <td class="table-active text-center">{{$value->warehouse_id}}</td>
                            <td class="text-center" style="text-transform: capitalize;">
                                @if($value->status == "active")
                                <span class="text-success">Aktif</span>
                                @elseif($value->status == "full")
                                <span class="text-danger">Penuh</span>
                                @else
                                <span class="text-secondary">Belum diSet</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Active Table -->
            </div>
        </div>
        <!-- Product Classification Modal -->
        <div class="modal fade" id="klasifikasiProduk" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulir Klasifikasi Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-9">
                                <form action="/classification" method="post">
                                    @csrf
                                    <select class="form-select" aria-label="Default select example" name="duration">
                                        <option selected>Pilih Durasi Klasifikasi</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                            </div>
                            <div class="col-3 py-2">
                                <span class="fw-semibold text-black">Bulan</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Classification Modal-->
    <!-- Tambah Rak Produk Modal -->
    <div class="modal fade" id="modaltambahgudang" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Gudang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/createwarehouse" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Nama Gudang</label>
                            <input type="text" class="form-control" name="warehouse_name" id="warehouse_name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="registered_date" id="registered_date">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->
    <div class="modal fade" id="modaltambahkategori" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/createcategory" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="category_name" id="category_name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->
    <!-- Tambah Rak Produk Modal -->
    <div class="modal fade" id="modaltambahlokasi" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/createlocation" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Nama Lokasi</label>
                            <input type="text" class="form-control" name="location_name" id="location_name">
                        </div>
                        <select name="warehouse_id" id="warehouse_id" class="form-select">
                            <option value="">--- Pilih Gudang ---</option>
                            @foreach($wh as $w)
                            <option value="{{$w->id}}">{{$w->warehouse_name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->
    <!-- Tambah Rak Modal -->
    <div class="modal fade" id="modaltambahrak" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Rak Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="/storeAddRack" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="form-label fw-semibold">Lokasi Rak</label>
                                <select name="location_id" id="location_id" class="form-select">
                                    <option value="" selected>--- Pilih Lokasi Rak ---</option>
                                    @foreach($bahanTG as $tg)
                                    <option value="{{$tg->id}}">{{$tg->location_name}} {{$tg->warehouse_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label fw-semibold">Nama Rak</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label fw-semibold">Nomor Rak</label>
                                <input class="form-control" type="number" name="rack_id" id="rack_id">
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label fw-semibold">Kategori</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="" selected>--- Pilih Kategori Rak ---</option>
                                    @foreach($category as $ct)
                                    <option value="{{$ct->id}}">{{$ct->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label fw-semibold">Kapasitas</label>
                                <input type="number" class="form-control" name="capacity" id="capacity">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Tambah Rak Modal-->
    <!-- Tambah Rak Produk Modal -->
    <div class="modal fade" id="tambahrakproduk" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Rak Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/createplacement" method="post">
                        @csrf
                        <select name="product_id" id="product_id" class="form-select mb-3">
                            <option value="">--- Pilih Produk ---</option>
                            @foreach($product as $value)
                            <option value="{{$value->id}}">{{$value->name}} {{$value->colors}}</option>
                            @endforeach
                        </select>
                        <select name="rack_id" id="rack_id" class="form-select mb-3">
                            <option value="">--- Pilih Rak ---</option>
                            @foreach($rack as $r)
                            <option value="{{$r->id}}">{{$r->name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->
    <!-- Tambah Rak Produk Modal -->
    <div class="modal fade" id="klasifikasiproduk" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Klasifikasi Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/createplacement" method="post">
                        @csrf
                        <select name="product_id" id="product_id" class="form-select mb-3">
                            <option value="">--- Pilih Produk ---</option>
                            @foreach($product as $value)
                            <option value="{{$value->id}}">{{$value->name}} {{$value->colors}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->
</div>
</div>

@endsection
