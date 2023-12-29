@extends('tmp')
@section('content')
<form action="{{ route('bukus.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Barang:</strong>
                <input type="text" name="nama_buku" class="form-control" placeholder="nama_buku">
                @error('nama_buku')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Penerbit</strong>
                <input type="text" name="penerbit" class="form-control" placeholder="penerbit">
                @error('penerbit')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tahun Terbit:</strong>
                <input type="text" name="tahun_terbit" class="form-control" placeholder="tahun_terbit">
                @error('tahun_terbit')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2 ml-3">Submitt</button>
    </div>
</form>
@endsection