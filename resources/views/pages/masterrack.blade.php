@extends('layout.master')
@section('page', 'Daftar Rak dalam Gudang')
@section('content')

<div class="card px-2">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">{{$wh->warehouse_name}}</span> | Daftar Rak</h5>
        </div>
        <div class="new-data d-flex justify-content-end px-2 mb-3">
            <img src="/assets/img/plus.png" alt="new data" style="width:3%" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahlokasi">Tambah Lokasi</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahkategori">Tambah Kategori</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body mt-3">
        @foreach($lc as $l)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accord-{{$l->id}}" aria-expanded="true" aria-controls="accord-">
                        <span class="fw-bold">{{$l->location_name}}</span>
                    </button>
                </h2>
                <div id="accord-{{$l->id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-semibold mb-3">Daftar Rak Pada Ruang <span class="fw-bold text-primary"></span></h6>
                            <div class="filter">
                                <a class="icon fs-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Menu Ruang</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahrak-{{$l->id}}">Tambah Rak</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteLocation-">Hapus Ruangan</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- if() -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor Rak</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Kapasitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(empty($rk[$l->id]))
                                <p>no data entries</p>
                                @else
                                @foreach($rk[$l->id] as $r)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="/selected-rack/{{$r->id}}" class="text-black">{{$r->name}}</a></td>
                                    <td>{{$r->rack_id}}</td>
                                    <td>{{$r->category_id}}</td>
                                    <td>{{$r->capacity}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambah Rak Modal -->
        <div class="modal fade" id="modaltambahrak-{{$l->id}}" tabindex="-1">
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
                                    <label for="" class="form-label fw-semibold">Nama Rak</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <input type="text" name="location_name" value="{{$l->location_name}}" hidden>
                                <input type="number" name="location_id" value="{{$l->id}}" hidden>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label fw-semibold">Kategori</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="" selected>--- Pilih Kategori Rak ---</option>
                                        @foreach($ct as $cts)
                                        <option value="{{$cts->id}}">{{$cts->category_name}}</option>
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
        @endforeach
        <!-- Default Accordion -->
        <!-- Tambah Lokasi Modal -->
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
                                <input type="number" name="warehouse_id" value="{{$wh->id}}" hidden>
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
        <!-- End Location Modal-->
        <!-- Category Modal-->
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
    </div>
</div>
@endsection
