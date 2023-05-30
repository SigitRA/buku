@extends('tmp')
@section('content')
<form action="{{ route('raks.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Rak:</strong>
                <input type="text" name="nama_rak" class="form-control" placeholder="nama_rak">
                @error('nama_rak')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>kapasitas:</strong>
                <input type="text" name="kapasitas" class="form-control" placeholder="kapasitas">
                @error('kapasitas')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2 ml-3">Submit</button>
    </div>
</form>
@endsection