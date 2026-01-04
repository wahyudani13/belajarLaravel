@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>Tambah Data Barang</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/barang" type="button" class="btn btn-success">Kembali Ke View Data Barang</a>
        </div>
    </div>
    <!-- <div class="row"> -->
    <form action="/barang" method="post">
        @csrf
        <div class="row mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" placeholder="AUTO INCREMENT" disabled>
        </div>
        <div class="row mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
            @error('nama_barang')
            <div class="form-text text-danger" id="nama_baranghelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="harga_barang" class="form-label">Harga Barang</label>
            <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="Harga Barang">
            @error('harga_barang')
            <div class="form-text text-danger" id="harga_baranghelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="keterangan_barang" class="form-label">Keterangan Barang</label>
            <textarea class="form-control" id="keterangan_barang" name="keterangan_barang" rows="3" placeholder="Keterangan Barang"></textarea>
            @error('keterangan_barang')
            <div class="form-text text-danger" id="keterangan_barang">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <input type="submit" class="btn btn-lg btn-primary pull-right" name="submit" value="Add">
            <a href="/barang" type="button" class="ml-3 btn btn-lg btn-danger">Batalkan</a>
        </div>
    </form>
    <!-- </div> -->
</div>
@endsection