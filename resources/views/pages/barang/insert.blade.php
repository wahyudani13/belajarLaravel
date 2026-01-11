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
            <div class="col-6">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang">
                @error('kode_barang')
                <div class="form-text text-danger" id="kode_baranghelp">{{$message}}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                @error('nama_barang')
                <div class="form-text text-danger" id="nama_baranghelp">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang">
                @error('harga')
                <div class="form-text text-danger" id="hargahelp">{{$message}}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="stok" class="form-label">Stok Barang</label>
                <input type="number" name="stok" id="stok" class="form-control" placeholder="Stok Barang">
                @error('stok')
                <div class="form-text text-danger" id="stok">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <input type="submit" class="btn btn-lg btn-primary pull-right" name="submit" value="Add">
            <a href="/barang" type="button" class="ml-3 btn btn-lg btn-danger">Batalkan</a>
        </div>
    </form>
    <!-- </div> -->
</div>
@endsection