@extends('tmp')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
  <a class="btn btn-primary" style="margin-top: 20px;" href="{{ route('pembelis.chartLine') }}">Chart</a>
</div>
<div class="text-end mb-2">
  <a class="btn btn-success" style="margin-top: 10px;" href="{{ route('pembelis.create') }}">Tambah Pembelian</a>
</div>
<br>
<table class="table table-success table-striped">
  <thead>
  <tbody class="table-succes ">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Pembeli</th>
      <th scope="col">jenis_kelamin</th>
      <th scope="col">Aksi</th>
    </tr>
    </thead>
  <tbody>
    @php $no = 1 @endphp
    @foreach ($pembelis as $data)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $data->nama_pembeli }}</td>
      <td>{{ $data->jenis_kelamin }}</td>
      <td>
        <form action="{{ route('pembelis.destroy',$data->id) }}" method="Post">
          <a class="btn btn-warning" href="{{ route('pembelis.edit',$data->id) }}">Edit</a>
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