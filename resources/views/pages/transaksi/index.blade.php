@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>View Data Transaksi</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/transaksi/create" type="button" class="btn btn-primary">Tambah Data Transaksi</a>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-info table-striped">
            <tr>
                <th>No.</th>
                <th class="text-center">ID Transaksi</th>
                <th class="text-center">Tanggal Transaksi</th>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Grand Total</th>
                <th class="text-center">Action</th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($dataJoin as $row)
            <tr>
                <td>{{$no++}}</td>
                <td class="text-center">{{$row->transaksi_id}}</td>
                <td class="text-center">{{$row->tanggal}}</td>
                <td class="text-center">{{$row->nama_pegawai}}</td>
                <th class="text-center">{{$row->grandtotal_harga}}</th>
                <td class="d-flex justify-content-between">
                    <a href="/transaksi/{{$row->transaksi_id}}/edit" class="btn btn-sm btn-primary">Edit</a>
                    <form action="/delete/{{$row->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection