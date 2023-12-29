@extends('tmp')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('bukus.create') }}">Add Barang</a>
</div>
<br>
<table class="table table-success table-striped">
    <thead>
    <tbody class="table-succes ">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Buku</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Tahun Terbit</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($bukus as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama_buku }}</td>
            <td>{{ $data->penerbit }}</td>
            <td>{{ $data->tahun_terbit }}</td>
            <td>
                <form action="{{ route('bukus.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('bukus.edit',$data->id) }}">Edit</a>
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
@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection