@extends('tmp')
@section('content')
<form action="{{ route('barangs.update',$barang->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Barang:</strong>
                <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="form-control" placeholder="barang name">
                @error('nama_barang')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> Harga Barang:</strong>
                <input type="number" name="harga_barang" class="form-control" placeholder="barang harga" value="{{ $barang->harga_barang }}">
                @error('harga_barang')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>stok:</strong>
                <input type="text" name="stok" value="{{ $barang->stok }}" class="form-control" placeholder="barangstok">
                @error('stok')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>rak:</strong>
                <input type="text" name="rak" value="{{ $barang->rak }}" class="form-control" placeholder="barangrak">
                @error('rak')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>
@endsection