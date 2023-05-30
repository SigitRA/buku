@extends('tmp')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('position.exportExcel') }}">Export Excel</a>
</div>
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('positions.create') }}">Add Position</a>
</div>
<br>
<table class="table table-success table-striped">
    <thead>
    <tbody class="table-succes ">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Alias</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($positions as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->keterangan }}</td>
            <td>{{ $data->alias }}</td>
            <td>
                <form action="{{ route('positions.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('positions.edit',$data->id) }}">Edit</a>
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