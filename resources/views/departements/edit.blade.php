@extends('app')
@section('content')
<form action="{{ route('departements.update',$departement->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>nama_barang:</strong>
                <input type="text" name="nama_barang" value="{{ $departement->nama_barang }}" class="form-control" placeholder="departement nama_barang">
                @error('nama_barang')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> stok:</strong>
                <input type="number" name="stok" class="form-control" placeholder="departement stok" value="{{ $departement->stok }}">
                @error('stok')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> harga:</strong>
                <input type="number" name="harga" value="{{ $departement->harga }}" class="form-control" placeholder="departement harga">
                @error('harga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>
@endsection