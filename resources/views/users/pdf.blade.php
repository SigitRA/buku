@extends('layout')
@section('content')
<table class="table table-primary table-striped">
    <thead>
    <tbody>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Position</th>
            <th scope="col">Departement</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($users as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->position}}</td>
            <td>{{$data->departement}}</td>
        </tr>
        <?php $no++; ?>
        @endforeach
    </tbody>
</table>
@endsection