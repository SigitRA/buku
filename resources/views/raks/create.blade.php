@extends('app')
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

        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Nama">
                @error('search')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 form-group text-center">
                <button class="btn btn-primary" type="button" name="btnAdd" id="btnAdd" onclick="tambahData()"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <table id="example" class="table table-striped table-success" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Rak</th>
                    </tr>
                </thead>
                <tbody id="detail">

                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary mt-2 ml-3">Submit</button>
    </div>
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
            // console.log(ui.item);
            add(ui.item.id);
            return false;
        }
    });

    function add(id) {
        const path = "{{ route('barangs.index') }}/" + id;
        var html = "";
        var no = 0;
        if ($('#detail tr').length > 0) {
            var html = $('#detail').html();
            no = no + $('#detail tr').length
        }
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            success: function(data) {
                console.log(data);
                no++;
                html += '<tr>' +
                    '<td>' + no + '<input type="hidden" name="id' + no + '" class="form-control" value="' + data.id + '"></td>' +
                    '<td><input type="text" name="nama_barang' + no + '" class="form-control" value="' + data.nama_barang + '"></td>' +
                    '<td><input type="number" name="harga_barang' + no + '" class="form-control" value="' + data.harga_barang + '"></td>' +
                    '<td><input type="number" name="stok' + no + '" class="form-control" value="' + data.stok + '"></td>' +
                    '<td><input type="text" name="rak' + no + '" class="form-control" value="' + data.rak + '"></td>' +
                    '<td><a href="#" class="btn btn-sm btn-danger">X</a></td>' +
                    '</tr>';
                $('#detail').html(html);
            }
        });
    }
</script>
@endsection