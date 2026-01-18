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
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$row->transaksi_id}}">
                        Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@foreach ($dataJoin as $row)
<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$row->transaksi_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/transaksi/{{$row->transaksi_id}}" method="post" class="modal-content">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus Data Transaksi {{$row->transaksi_id}}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection