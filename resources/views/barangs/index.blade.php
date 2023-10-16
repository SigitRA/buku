@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('barangs.create') }}">Add Barang</a>
</div>
<br>
<table class="table table-success table-striped">
    <thead>
    <tbody class="table-succes ">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Harga Barang</th>
            <th scope="col">Kondisi Barang</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($barangs as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama_barang }}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->kondisi_barang }}</td>
            <td>
                <form action="{{ route('barangs.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('barangs.edit',$data->id) }}">Edit</a>
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