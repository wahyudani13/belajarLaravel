@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>Tambah Data Pegawai</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/pegawai" type="button" class="btn btn-success">Kembali Ke View Data Pegawai</a>
        </div>
    </div>
    <!-- <div class="row"> -->
    <form action="/pegawai" method="post">
        @csrf
        <div class="row mb-3">
            <label for="id" class="form-label">ID PEGAWAI</label>
            <input type="text" class="form-control" id="id" placeholder="AUTO INCREMENT" disabled>
        </div>
        <div class="row mb-3">
            <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai">
            @error('nama_pegawai')
            <div class="form-text text-danger" id="nama_pegawaihelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="jabatan_pegawai" class="form-label">Jabatan Pegawai</label>
            <input type="text" class="form-control" id="jabatan_pegawai" name="jabatan_pegawai" placeholder="Jabatan Pegawai">
            @error('jabatan_pegawai')
            <div class="form-text text-danger" id="jabatan_pegawaihelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="usia_pegawai" class="form-label">Usia Pegawai</label>
            <input type="number" class="form-control" id="usia_pegawai" name="usia_pegawai" placeholder="Usia Pegawai">
            @error('usia_pegawai')
            <div class="form-text text-danger" id="usia_pegawaihelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="alamat_pegawai" class="form-label">Alamat Pegawai</label>
            <textarea class="form-control" id="alamat_pegawai" name="alamat_pegawai" rows="3" placeholder="Alamat Pegawai"></textarea>
            @error('alamat_pegawai')
            <div class="form-text text-danger" id="alamat_pegawaihelp">{{$message}}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <input type="submit" class="btn btn-lg btn-primary pull-right" name="submit" value="Add">
            <a href="/pegawai" type="button" class="ml-3 btn btn-lg btn-danger">Batalkan</a>
        </div>
    </form>
</div>
@endsection