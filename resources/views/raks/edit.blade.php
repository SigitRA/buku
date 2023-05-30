@extends('tmp')
@section('content')
<form action="{{ route('raks.update',$rak->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rak Name:</strong>
                <input type="text" name="nama_rak" value="{{ $rak->nama_rak }}" class="form-control" placeholder="rak name">
                @error('nama_rak')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> Kapasitas:</strong>
                <input type="keterangan" name="kapasitas" class="form-control" placeholder="rak kapasitas" value="{{ $rak->kapasitas }}">
                @error('kapasitas')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>
@endsection