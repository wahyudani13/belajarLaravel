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
            <input type="text" class="form-control" id="id" name="id" placeholder="AUTO INCREMENT" readonly>
        </div>
        <div class="row mb-3">
            <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai">
            @error('nama_pegawai')
            <div class="form-text text-danger" id="nama_pegawaihelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="jabatan" class="form-label">Jabatan Pegawai</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan Pegawai">
            @error('jabatan')
            <div class="form-text text-danger" id="jabatanhelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="email" class="form-label">Email Pegawai</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email Pegawai">
            @error('email')
            <div class="form-text text-danger" id="emailhelp">{{$message}}</div>
            @enderror
        </div>
        <!-- <div class="row mb-3">
            <label for="alamat_pegawai" class="form-label">Alamat Pegawai</label>
            <textarea class="form-control" id="alamat_pegawai" name="alamat_pegawai" rows="3" placeholder="Alamat Pegawai"></textarea>
            @error('alamat_pegawai')
            <div class="form-text text-danger" id="alamat_pegawaihelp">{{$message}}</div>
            @enderror
        </div> -->

        <div class="row mb-3">
            <input type="submit" class="btn btn-lg btn-primary pull-right" name="submit" value="Add">
            <a href="/pegawai" type="button" class="ml-3 btn btn-lg btn-danger">Batalkan</a>
        </div>
    </form>
</div>
@endsection