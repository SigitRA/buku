@extends('tmp')
@section('content')
<form action="{{ route('bukus.update',$buku->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama buku:</strong>
                <input type="text" name="nama_buku" class="form-control" value="{{ $buku->nama_buku }}" placeholder="nama_buku">
                @error('nama_buku')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Penerbit</strong>
                <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit }}" placeholder="penerbit">
                @error('penerbit')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kondisi buku:</strong>
                <input type="text" name="tahun_terbit" class="form-control" value="{{ $buku->tahun_terbit }}" placeholder="tahun_terbit">
                @error('tahun_terbit')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-3 mt-3">Submit</button>
    </div>
</form>
@endsection