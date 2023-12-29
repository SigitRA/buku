@extends('tmp')
@section('content')
<form action="{{ route('penyimpanans.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>No Simpan</strong>
                <input type="text" name="no_simpan" class="form-control" placeholder="No simpan">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lorong :</strong>
                <input type="text" name="lorong" class="form-control" placeholder="lorong">
                @error('location')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Penyimpanan:</strong>
                <input type="date" name="tanggal" class="form-control" placeholder="Tanggal penyimpanan">
                @error('location')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>genre :</strong>
                <input type="text" name="genre" class="form-control" placeholder="genre">
                @error('location')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Nama Barang">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 form-group text-center">
                <button class="btn btn-success" type="button" name="btnAdd" id="btnAdd"><i class="fa fa-plus"></i>Tambah</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <table id="example" class="table table-striped table-success" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="detail">

                </tbody>
            </table>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="text" name="jml" class="form-control">
                <div class="form-group">
                    <strong>Grand Total:</strong>
                    <input type="text" name="total" class="form-control" placeholder="0">
                    @error('genre')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
    </div>
</form>
@endsection
@section('js')
<script type="text/javascript">
    var path = "{{ route('search.buku') }}";

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
            console.log($("input[name=jml]").val());
            if ($("input[name=jml]").val() > 0) {
                for (let i = 1; i <= $("input[name=jml]").val(); i++) {
                    id = $("input[name=id_product" + i + "]").val();
                    if (id == ui.item.id) {
                        alert(ui.item.value + ' sudah ada!');
                        break;
                    } else {
                        add(ui.item.id);
                    }
                }
            } else {
                add(ui.item.id);
            }
            return false;
        }
    });


    function add(id) {
        const path = "{{ route('bukus.index') }}/" + id;
        var html = "";
        var no = 0;
        if ($('#detail tr').length > no) {
            html = $('#detail').html();
            no = no + $('#detail tr').length;
        }
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            success: function(data) {
                console.log(data);
                no++;
                html += '<tr>' +
                    '<td>' + no + '<input type="hidden" name="id_buku' + no + '" class="form-control" value="' + data.id + '"></td>' +
                    '<td><input type="text" name="nama_buku' + no + '" class="form-control" value="' + data.nama_buku + '"></td>' +
                    '<td><input type="text" name="stok' + no + '" class="form-control" oninput="sumstok(' + no + ', this.value)" value="1"></td>' +
                    '<td><input type="text" name="sub_total' + no + '" class="form-control"></td>' +
                    '<td><a href="#" class="btn btn-sm btn-danger">X</a></td>' +
                    '</tr>';
                $('#detail').html(html);
                $("input[name=jml]").val(no);
                sumstok(no, 1);
            }
        });
    }

    function sumstok(no, q) {
    var stok = $("input[name=stok" + no + "]").val();
    
    var subtotal = parseInt(stok); // Calculate subtotal based on stok
    
    $("input[name=sub_total" + no + "]").val(subtotal);
    console.log("Stok " + stok + " = Subtotal " + subtotal);
    sumTotal();
}

    function sumTotal() {
        var total = 0;
        for (let i = 1; i <= $("input[name=jml]").val(); i++) {
            var sub = $("input[name=sub_total" + i + "]").val();
            total = total + parseInt(sub);
        }
        $("input[name=total]").val(total);
    }
</script>
@endsection