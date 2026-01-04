@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>View Data Barang</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/barang/create" type="button" class="btn btn-success">Tambah Data Barang</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-info table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Harga Barang</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php $no = 1; ?>
            <tbody>
                @foreach ($data as $row)
                <tr>
                    <td>{{$no++}}</td>
                    <td class="text-center">{{$row->id}}</td>
                    <td class="text-center">{{$row->nama_barang}}</td>
                    <td class="text-center">{{$row->harga_barang}}</td>
                    <td class="text-center">{{$row->keterangan_barang}}</td>
                    <td class="text-center">{{$row->created_at}}</td>
                    <td class="text-center">{{$row->updated_at}}</td>
                    <td class="text-center">
                        <a href="/barang/{{$row->id}}/edit" type="button" class="btn btn-sm btn-primary">Ubah</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$row->id}}">
                            Hapus
                        </button>
                        <!-- <form class="" action="/barang/{{$row->id}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@foreach ($data as $row)
<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$row->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/barang/{{$row->id}}" method="post" class="modal-content">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus {{$row->nama_barang}}?
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