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

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <input type="search" name="search" class="form-control" placeholder="search">
                @error('search')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary mt-2 ml-3 float-right">Tambah</button>
            </div>
        </div>


    </div>
    <table class="table table-success table-striped mt-3">
        <thead>
        <tbody class="table-succes ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Stok</th>
                <th scope="col">Rak</th>
            </tr>
            </thead>

            <button type="submit" class="btn btn-primary mt-2 ml-3">Submit</button>
</form>
@endsection
@section('js')
<script type="text/javascript">
    var path = "{{ route('search.barang') }}";

    $("#search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: path,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            $('#search').val(ui.item.label);
            console.log(ui.item);
            return false;
        }
    });
</script>
@endsection