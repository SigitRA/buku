@extends('layout')
@section('content')
<table class="table table-primary table-striped">
    <thead>
    <tbody>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Location</th>
            <th scope="col">Manager id</th>
        </tr>
        </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($departements as $data)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->location}}</td>
            <td>
                {{
                    (isset($data->manager->email)) ?
                $data->manager->email :
                'Tidak Ada'
                }}
            </td>
        </tr>
        <?php $no++; ?>
        @endforeach
    </tbody>
</table>
@endsection