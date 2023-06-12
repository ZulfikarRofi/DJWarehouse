@extends('layout.master')
@section('page', 'Product Dashboard')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Product Page | Halaman Tabel Produk Toko UD. Dewa Jaya</h5>
            <div class="d-flex justify-content-end">
                <div class="search-bar mt-3 px-2">
                    <form class="search-form d-flex align-items-center" method="POST" action="#">
                        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div><!-- End Search Bar -->
            </div>
        </div>
        <div class="row d-flex justify-content-end px-2 mb-3">
            <img src="/assets/img/plus.png" alt="new data" style="width:5%" data-bs-toggle="modal" data-bs-target="#productmodal">
            <!-- New Transaction Form Modal -->
            <div class="modal fade" id="productmodal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Transaksi Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row d-flex justify-content-center mb-4">
                                <img id="output" alt="" style="width:30rem">
                            </div>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="/createproduct" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Gambar Produk</label>
                                    <input type="file" class="form-control" id="image" name="image" onchange="loadFile(event)">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Tipe</label>
                                    <select name="type" id="type" class="form-select">
                                        <option value="" selected>--- Pilih tipe produk ---</option>
                                        <option value="glossy">Glossy</option>
                                        <option value="matt">Matt</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Kualitas Produk</label>
                                    <select name="quality" id="quality" class="form-select">
                                        <option value="" selected>--- Pilih kualitas produk ---</option>
                                        <option value="kwi">KW I</option>
                                        <option value="kwii">KW II</option>
                                        <option value="kwiii">KW III</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Ukuran Produk</label>
                                    <select name="size" id="size" class="form-select">
                                        <option value="" selected>--- Pilih ukuran produk ---</option>
                                        <option value="15x15">15 x 15</option>
                                        <option value="30x30">30 x 30</option>
                                        <option value="30x60">30 x 60</option>
                                        <option value="60x60">60 x 60</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Merek</label>
                                    <input type="text" class="form-control" id="merk" name="merk">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Warna</label>
                                    <input type="text" class="form-control" id="colors" name="colors">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Harga Jual</label>
                                    <input type="number" class="form-control" id="sell_price" name="sell_price">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Harga Beli</label>
                                    <input type="number" class="form-control" id="buy_price" name="buy_price">
                                </div>
                        </div>
                        <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                            };
                        </script>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body mb-3">
            <!-- Bordered Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center" style="width:20%">Foto Produk</th>
                        <th scope="col" class="text-center" style="width:10%">Item</th>
                        <th scope="col" class="text-center" style="width:10%">Tipe</th>
                        <th scope="col" class="text-center" style="width:10%">Warna</th>
                        <th scope="col" class="text-center" style="width:10%">Ukuran</th>
                        <th scope="col" class="text-center" style="width:10%">Merk</th>
                        <th scope="col" class="text-center" style="width:10%">Harga/Unit</th>
                        <th scope="col" class="text-center" style="width:10%">Stok</th>
                        <th scope="col" class="text-center" style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($result == null)]
                    @php($i = 1)
                    @foreach($product as $value)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if($value->image == null)
                                <img src="/assets/img/no-pictures.png" alt="no images" style="width: 50%;">
                                @else
                                <img src="/image/{{$value['image']}}" alt="no images" style="width: 50%;">
                                @endif
                            </div>
                        </td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value->name}}</td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value->product_type}}</td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value->colors}}</td>
                        <td class="text-center">{{$value->size}}</td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value->merk}}</td>
                        <td class="text-center"> Rp. {{number_format($value->sell_price, 0 , ',' , '.')}},-</td>
                        <td class="text-center">{{$value->stock}} Pcs</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <img src="/assets/img/edit.png" alt="edit" style="width:25%">
                                <img class="ms-2" src="/assets/img/delete.png" alt="edit" style="width:25%" data-bs-toggle="modal" data-bs-target="#delete-{{$value->id}}">
                                <!-- Delete Product Modal -->
                                <div class="modal fade" id="delete-{{$value['id']}}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Data Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin menghapus produk ini <span class="fw-bold">"{{$value->name}}"</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="/deleteproduct/{{$value->id}}" method="post">
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
                    @endif
                    @php($i = 1)
                    @foreach($result as $value)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if($value['image'] == null)
                                <img src="/assets/img/no-pictures.png" alt="no images" style="width: 50%;">
                                @else
                                <img src="/image/{{$value['image']}}" alt="no images" style="width: 50%;">
                                @endif
                            </div>
                        </td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value['name']}}</td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value['product_type']}}</td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value['colors']}}</td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value['size']}}</td>
                        <td class="text-center" style="text-transform: capitalize;">{{$value['merk']}}</td>
                        <td class="text-center"> Rp. {{number_format($value['sell_price'], 0 , ',' , '.')}},-</td>
                        <td class="text-center">{{$value['stock']}} Pcs</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <img src="/assets/img/edit.png" alt="edit" style="width:25%">
                                <img class="ms-2" src="/assets/img/delete.png" alt="edit" style="width:25%" data-bs-toggle="modal" data-bs-target="#delete-{{$value['id']}}">
                                <!-- Delete Product Modal -->
                                <div class="modal fade" id="delete-{{$value['id']}}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Data Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin menghapus produk ini <span class="fw-bold">"{{$value['name']}}"</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="/deleteproduct/{{$value['id']}}" method="post">
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
            <!-- End Bordered Table -->
        </div>
    </div>
</div>
@endsection