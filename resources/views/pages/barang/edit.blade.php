@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>Ubah Data Barang</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/barang" type="button" class="btn btn-success">Kembali Lihat Data Barang</a>
        </div>
    </div>
    <!-- <div class="row"> -->
    <form action="/barang/{{$data->id}}" method="POST">
        @method('PUT')
        @csrf
        <div class="row mb-3">
            <div class="col-6">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="AUTO INCREMENT" readonly value="{{ old('kode_barang', $data->kode_barang) }}">
            </div>
            <div class="col-6">
                <label for="id" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="AUTO INCREMENT" readonly value="{{ old('id', $data->id) }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="{{ old('nama_barang', $data->nama_barang) }}">
            @error('nama')
            <div class="form-text text-danger" id="nama_baranghelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="harga" class="form-label">Harga Barang</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang" value="{{ old('harga', $data->harga) }}">
            @error('harga')
            <div class="form-text text-danger" id="hargahelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="stok" class="form-label">Keterangan</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Barang" value="{{ old('stok', $data->stok) }}">
            @error('stok')
            <div class="form-text text-danger" id="stokhelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <input type="submit" class="btn btn-lg btn-primary pull-right" name="submit" value="Simpan Data">
            <a href="/barang" type="button" class="ml-3 btn btn-lg btn-danger">Batalkan</a>
        </div>
    </form>
    <!-- </div> -->
</div>
@endsection