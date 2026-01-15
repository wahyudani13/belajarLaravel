@extends('layouts.master')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-box-seam"></i> Tabel Barang
                    </h5>
                    <a href="/barang" class="btn btn-outline-light btn-primary">
                        <i class="bi bi-eye"></i> Lihat Barang
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-receipt"></i> Tabel Transaksi Header
                    </h5>
                    <a href="/transaksi" class="btn btn-outline-light btn-primary">
                        <i class="bi bi-eye"></i> Lihat Transaksi Header
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-people"></i> Tabel Pegawai
                    </h5>
                    <a href="/pegawai" class="btn btn-outline-light btn-primary">
                        <i class="bi bi-eye"></i> Lihat Pegawai
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-list-check"></i> Tabel Transaksi Detail
                    </h5>
                    <a href="/" class="btn btn-outline-light btn-primary">
                        <i class="bi bi-eye"></i> Lihat Transaksi Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-plus-circle"></i> Buat Transaksi
                    </h5>
                    <a href="/inputTransaksi" class="btn btn-outline-light btn-primary">
                        <i class="bi bi-pencil-square"></i> Masukkan Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection