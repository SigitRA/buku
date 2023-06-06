@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('raks.create') }}">Add Rak</a>
</div>
<br>
<table class="table table-success table-striped">
    <thead>
    <tbody class="table-succes ">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Rak</th>
            <th scope="col">Kapasitas</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($raks as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama_rak }}</td>
            <td>{{ $data->kapasitas }}</td>
            <td>
                <form action="{{ route('raks.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('raks.edit',$data->id) }}">Edit</a>
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