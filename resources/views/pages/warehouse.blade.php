@extends('layout.master')
@section('page', 'Manajemen Gudang')
@section('content')

<div class="card px-2">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Menu Gudang | Halaman Tabel Produk Pada Gudang Toko UD. Dewa Jaya</h5>
            <div class="d-flex justify-content-end">
                <div class="search-bar mt-3 px-2">
                    <form class="search-form d-flex align-items-center" method="POST" action="#">
                        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div><!-- End Search Bar -->
            </div>
        </div>
        <div class="new-data d-flex justify-content-end px-2 mb-3">
            <img src="/assets/img/plus.png" alt="new data" style="width:3%" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahgudang">Tambah Gudang</a></li>
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
                            <th scope="col">Tanggal Registrasi</th>
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
                                @if($value->location == "front")
                                Depan
                                @elseif($value->location == "middle")
                                Tengah
                                @elseif($value->location == "back")
                                Belakang
                                @endif
                            </td>
                            <td class="text-center">
                                @if($value->category == "A")
                                <span class="badge bg-success">A</span>
                                @elseif($value->category == "B")
                                <span class="badge bg-warning">B</span>
                                @elseif($value->category == "C")
                                <span class="badge bg-secondary">C</span>
                                @endif
                            </td>
                            <td class="text-center">{{$value->registered_date}}</td>
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
        <div class="row mb-3">
            <!-- Active Table -->
            <p class="fw-bold">Daftar Produk Pada Gudang</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width:5%">#</th>
                        <th scope="col" class="text-center" style="width:15%">Nama</th>
                        <th scope="col" class="text-center" style="width:10%">ID</th>
                        <th scope="col" class="text-center" style="width:10%">Kategori</th>
                        <th scope="col" class="text-center" style="width:5%">Kelas</th>
                        <th scope="col" class="text-center" style="width:10%">Rak</th>
                        <th scope="col" class="text-center" style="width:10%">Gudang</th>
                        <th scope="col" class="text-center" style="width:10%">Lokasi</th>
                        <th scope="col" class="text-center" style="width:15%">Stok Gudang</th>
                        <th scope="col" class="text-center" style="width:10%">Permintaan(/Tahun)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-center">1</th>
                        <td class="text-center">Corsica Red</td>
                        <td class="table-active text-center">620230603</td>
                        <td class="text-center">Keramik</td>
                        <td class="text-center">A</td>
                        <td class="text-center">A-1</td>
                        <td class="text-center">Gudang A</td>
                        <td class="text-center">Depan</td>
                        <td class="text-center">100</td>
                        <td class="text-center">75</td>
                    </tr>
                </tbody>
            </table>
            <!-- End Active Table -->
        </div>
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
                            <form action="">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Gudang</label>
                                    <select name="warehouse_id" id="warehouse_id" class="form-select">
                                        <option value="">--- Pilih Gudang ---</option>
                                        @foreach($wh as $w)
                                        <option value="{{$w->id}}">{{$w->warehouse_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label fw-semibold">Lokasi Rak</label>
                                    <select name="location" id="location" class="form-select">
                                        <option value="" selected>--- Pilih Lokasi Rak ---</option>
                                        @foreach($lc as $l)
                                        <option value="{{$l->id}}">{{$l->location_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label fw-semibold">Nama Rak</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">AA</span><input class="form-control" type="number" name="frontnumber" id="frontnumber" placeholder="Nomor Rak">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">BB</span><input class="form-control" type="number" name="middlenumber" id="middlenumber" placeholder="Nomor Rak">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">CC</span><input class="form-control" type="number" name="backnumber" id="backnumber" placeholder="Nomor Rak">
                                </div>
                                <script>
                                    var locationOption = document.getElementById('location');
                                    var inputFront = document.getElementById('frontnumber');
                                    var inputMiddle = document.getElementById('middlenumber');
                                    var inputBack = document.getElementById('backnumber');

                                    locationOption.addEventListener('change', function() {
                                        var locationOption = locationOption.value;
                                        console.log(test)

                                        //Hide Input Rack Number
                                        inputFront.style.display = 'none';
                                        inputMiddle.style.display = 'none';
                                        inputBack.style.display = 'none';

                                        //show the correcting input field based on the selected option
                                        if (locationOption === 'front') {
                                            inputFront.style.display = 'block';
                                        } else if (locationOption === 'middle') {
                                            inputMiddle.style.display = 'middle';
                                        } else if (locationOption === 'back') {
                                            inputBack.style.display = 'back';
                                        }
                                    });
                                </script>
                                <div class="form-group ">

                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label fw-semibold">Kapasitas</label>
                                    <input type="number" class="form-control" name="capacity" id="capacity">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
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
                        <form action="">
                            <select name="" id="" class="form-select mb-3">
                                <option value="">--- Pilih Produk ---</option>
                                @foreach($product as $value)
                                <option value="{{$value->name}}">{{$value->name}} {{$value->colors}}</option>
                                @endforeach
                            </select>
                            <select name="" id="" class="form-select mb-3">
                                <option value="">--- Pilih Gudang ---</option>
                                @foreach($wh as $w)
                                <option value="{{$w->warehouse_name}}">{{$w->warehouse_name}}</option>
                                @endforeach
                            </select>
                            <select name="" id="" class="form-select mb-3">
                                <option value="">--- Pilih Lokasi ---</option>
                                <option value="">1</option>
                            </select>
                            <select name="" id="" class="form-select mb-3">
                                <option value="">--- Pilih Rak ---</option>
                                @foreach($rack as $r)
                                <option value="{{$r->name}}">{{$r->name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div><!-- End Vertically centered Modal-->
    </div>
</div>

@endsection