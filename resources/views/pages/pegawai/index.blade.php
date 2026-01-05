@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>View Data Pegawai</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/pegawai/create" type="button" class="btn btn-primary">Tambah Data Pegawai</a>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-info table-striped">
            <tr>
                <th>No.</th>
                <th class="text-center">ID</th>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Action</th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($data as $row)
            <tr>
                <td>{{$no++}}</td>
                <td class="text-center">{{$row->id}}</td>
                <td class="text-center">{{$row->nama_pegawai}}</td>
                <td class="text-center">{{$row->jabatan_pegawai}}</td>
                <td class="text-center">{{$row->alamat_pegawai}}</td>
                <td class="text-center">
                    <a href="/pegawai/{{$row->id}}/edit" type="button" class="btn btn-sm btn-primary">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$row->id}}">
                        Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@foreach ($data as $row)
<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$row->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/pegawai/{{$row->id}}" method="post" class="modal-content">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghentikan {{$row->nama_pegawai}}?
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