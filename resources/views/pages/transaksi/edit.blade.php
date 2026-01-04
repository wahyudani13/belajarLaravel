@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>Edit Data Barang</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/viewIndex" type="button" class="btn btn-primary">Back to View Data Barang</a>
        </div>
    </div>
    <!-- <div class="row"> -->
    <form action="/transaksi/{{$data->id}}" method="POST">
        @method('PUT')
        @csrf
        <div class="row mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id" placeholder="AUTO INCREMENT" readonly value="{{$data->id}}">
        </div>
        <div class="row mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="{{$data->nama_barang}}">
            @error('nama')
            <div class="form-text text-danger" id="nama_baranghelp">{{$message}}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <input type="submit" class="btn btn-lg btn-success pull-right" name="submit" value="Edit">
        </div>
    </form>
    <!-- </div> -->
</div>
@endsection