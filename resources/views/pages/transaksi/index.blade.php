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
                <th class="text-center">ID Barang</th>
                <th class="text-center">Harga Barang</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Action</th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($dataDetails as $row)
            <tr>
                <td>{{$no++}}</td>
                <td class="text-center">{{$row->transaksi_id}}</td>
                <td class="text-center">{{$row->barang_id}}</td>
                <td class="text-center">{{$row->harga}}</td>
                <td class="text-center">{{$row->jumlah}}</td>
                <td class="d-flex justify-content-between">
                    <a href="/transaksi/{{$row->id}}/edit" class="btn btn-sm btn-primary">Edit</a>
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