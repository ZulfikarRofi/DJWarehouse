@extends('layout.master')
@section('page', 'User Dashboard')
@section('content')

<div class="card p-5">
    <!-- Active Table -->
    @forelse($user as $value)
    @php($i = 1)
    <table class="table" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Level</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$value->username}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->level}}</td>
            </tr>
        </tbody>
    </table>
    @empty
    <div class="row">
        <div class="d-flex justify-content-center">
            <img src="assets/img/no-entry-data.png" alt="Empty" style="width: 50%;">
        </div>
    </div>
    @endforelse
    <!-- End Active Table -->
</div>


@endsection
