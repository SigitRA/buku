@extends('tmp')
@section('content')
<form action="{{ route('barangs.update',$barang->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Barang:</strong>
                <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" placeholder="nama_barang">
                @error('nama_barang')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga</strong>
                <input type="text" name="harga" class="form-control" value="{{ $barang->harga }}" placeholder="harga">
                @error('harga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kondisi Barang:</strong>
                <input type="text" name="kondisi_barang" class="form-control" value="{{ $barang->kondisi_barang }}" placeholder="kondisi_barang">
                @error('kondisi_barang')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-3 mt-3">Submit</button>
    </div>
</form>
@endsection