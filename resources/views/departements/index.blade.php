@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('departements.create') }}">Add Departement</a>
</div>
<br>
<table class="table table-primary table-striped">
    <thead>
    <tbody>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Stok</th>
            <th scope="col">Harga</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($departements as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->nama_barang }}</td>
            <td>{{ $data->stok}}</td>
            <td>{{ $data->harga }}</td>
            <td>
                <form action="{{ route('departements.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('departements.edit',$data->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection