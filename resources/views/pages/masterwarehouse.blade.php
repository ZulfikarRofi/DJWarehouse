@extends('layout.master')
@section('page', 'Master Gudang')
@section('content')

<div class="card px-2">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Menu Gudang | Daftar Gudang</h5>
        </div>
        <div class="new-data d-flex justify-content-end px-2 mb-3">
            <img src="/assets/img/plus.png" alt="new data" style="width:3%" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaltambahgudang">Tambah Gudang</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama</th>
                    <th scope="col" class="text-center">ID Gudang</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($wh as $value)
                <tr>
                    <td class="text-center" scope="row" style="width: 10%;">{{$i++}}</th>
                    <td class="text-center"><a href="/racks/{{$value->id}}"><span class="text-black">{{$value->warehouse_name}}</span></a></td>
                    <td class="table-active text-center">{{$value->warehouse_id}}</td>
                    <td class="text-center" style="text-transform: capitalize;">
                        @if($value->status == "active")
                        <span class="text-success">Aktif</span>
                        @elseif($value->status == "full")
                        <span class="text-danger">Penuh</span>
                        @else
                        <span class="text-secondary">Belum Di Set</span>
                        @endif
                    </td>
                    <td style="width: 10%;">
                        <div class="d-flex justify-content-center">
                            <img src="/assets/img/edit.png" alt="edit" style="width:25%">
                            <img class="ms-2" src="/assets/img/delete.png" alt="edit" style="width:25%" data-bs-toggle="modal" data-bs-target="#delete-{{$value->id}}">
                            <!-- Delete Product Modal -->
                            <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Data Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus gudang ini <span class="fw-bold">"{{$value->warehouse_name}}"</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="/deletewarehouse/{{$value->id}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Delete Product Modal-->
                        </div>
                    </td>
                </tr>
                @endforeach
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

@endsection
