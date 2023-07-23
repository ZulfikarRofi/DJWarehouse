@extends('layout.master')
@section('page', 'User Dashboard')
@section('content')

<div class="card px-2">
    <div class="card-header">
        <div class="row mb-3">
            <!-- Display error message -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Display success message -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Manajemen Pengguna | Data Pengguna</h5>
            <div class="py-3">
                <button class="btn btn-outline-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="bi bi-person-plus"></i> Tambah Pengguna</button>
            </div>
        </div>
    </div>
    <!-- Active Table -->
    @php($i = 1)
    <table class="table" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Level</th>
            </tr>
        </thead>
        <tbody>
            @forelse($user as $value)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td><img src="" alt="photo"></td>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->level}}</td>
            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
    <!-- End Active Table -->
    <!-- Tambah User Modal -->
    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/register" method="post">
                        @csrf
                        <div class="row mb-3 px-3">
                            <label for="yourName" class="form-label">Nama Pengguna</label>
                            <input type="text" name="name" class="form-control" id="yourName" required>
                            <div class="invalid-feedback">Please, enter your name!</div>
                        </div>
                        <label for="yourName" class="form-label">Level Pengguna</label>
                        <div class="row mb-3 px-3">
                            <select class="form-select" aria-label="Default select example" name="level">
                                <option selected>--- Pilih Level Pengguna ---</option>
                                <option value="owner">Owner</option>
                                <option value="admin toko">Admin Toko</option>
                                <option value="admin gudang">Admin Gudang</option>
                            </select>
                        </div>
                        <div class="row mb-3 px-3">
                            <label for="yourEmail" class="form-label">Email Pengguna</label>
                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                        </div>
                        <div class="row mb-3 px-3">
                            <label for="yourPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                            <div class="invalid-feedback">Please enter your password!</div>
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


@endsection
