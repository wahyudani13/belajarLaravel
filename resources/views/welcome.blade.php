@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-4">
            <div class="card text-center text-bg-secondary" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tabel Barang Header</h5>
                    <a href="/barang" class="btn btn-primary">Lihat Barang Header</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center text-bg-secondary" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tabel Transaksi Header</h5>
                    <a href="/transaksi" class="btn btn-primary">Lihat Transaksi Header</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        <div class="col-4">
            <div class="card text-center text-bg-secondary" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tabel Pegawai Header</h5>
                    <a href="/pegawai" class="btn btn-primary">Lihat Pegawai Header</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center text-bg-secondary" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tabel Transaksi Detail#</h5>
                    <a href="/" class="btn btn-primary">Lihat Transaksi Detail#</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card text-center text-bg-secondary" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Buat Transaksi Transaksi#</h5>
                    <a href="/" class="btn btn-primary">MASUKKAN TRANSAKSI#</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection