@extends('tmp')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
  <a class="btn btn-primary" style="margin-top: 20px;" href="{{ route('penyimpanans.chartLine') }}">Chart</a>
</div>
<div class="text-end mb-2">
  <a class="btn btn-success" style="margin-top: 10px;" href="{{ route('penyimpanans.create') }}">Tambah Pembelian</a>
</div>
<br>
<table class="table table-success table-striped">
  <thead>
  <tbody class="table-succes ">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Lorong</th>
      <th scope="col">Genre</th>
      <th scope="col">Aksi</th>
    </tr>
    </thead>
  <tbody>
    @php $no = 1 @endphp
    @foreach ($penyimpanans as $data)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $data->lorong }}</td>
      <td>{{ $data->genre }}</td>
      <td>
        <form action="{{ route('penyimpanans.destroy',$data->id) }}" method="Post">
          <a class="btn btn-warning" href="{{ route('penyimpanans.edit',$data->id) }}">Edit</a>
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