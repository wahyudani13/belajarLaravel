@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>View Data Pegawai</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/insert" type="button" class="btn btn-primary">Tambah Data Pegawai</a>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-info table-striped">
            <tr>
                <th>No.</th>
                <th class="text-center">ID</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Action</th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($data as $row)
            <tr>
                <td>{{$no++}}</td>
                <td class="text-center">{{$row->id}}</td>
                <td class="text-center">{{$row->nama_barang}}</td>
                <td class="text-center">{{$row->created_at}}</td>
                <td class="text-center">
                    <a href="/transaksi/{{$row->id}}/edit" type="button" class="btn btn-primary">Edit</a>
                    ||
                    <form action="/delete/{{$row->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection