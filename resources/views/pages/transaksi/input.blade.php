@extends('layouts.master')

@section('content')
<div class="row text-center justify-content-between">
    <div class="col-6 pull-left">
        <h1>Input Transaksi</h1>
    </div>
    <div class="col-3 pull-right">
        <a href="/transaksi" type="button" class="btn btn-success">Kembali Ke Menu</a>
    </div>
</div>

<form action="/transaksi" method="post">
    @csrf
    <div class="row mb-3 justify-content-end">
        <div class="col-6">
            <label for="id" class="form-label">ID Transaksi</label>
            <input type="text" class="form-control" id="id" name="id" placeholder="AUTO INCREMENT" readonly>
        </div>
        <div class="col-6">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi">
        </div>
    </div>
    <div class="row mb-3">
        <select class="form-select" id="getPegawai" name="getPegawai">
            <option>Pilih Pegawai</option>
            @foreach($getPegawai as $row)
            <option value="{{$row->id}}">{{$row->nama_pegawai}}</option>
            @endforeach
        </select>
    </div>
    <div class="row mb-3">
        <h4 class="text-center">MASUKKAN ITEM</h4>
    </div>

    <div id="formRows"></div>

    <div class="row mb-3">
        <button id="addRowBtn" type="button" class="btn btn-md btn-primary">Tambah Item</button>
    </div>

    <div class="row mb-3 justify-content-end">
        <div class="col-2">
            <h4 class="text-center">TOTAL</h4>
        </div>
        <div class="col-6">
            <input type="number" class="form-control" id="grand-total" name="grand-total" readonly placeholder="Rp 0">
        </div>
    </div>

    <div class="row mb-3 justify-content-end">
        <div class="col-2">
            <input type="submit" class="btn btn-lg btn-primary pull-right" name="submit" value="Add">
        </div>
        <div class="col-2">
            <a href="/transaksi" type="button" class="ml-3 btn btn-lg btn-danger">Batalkan</a>
        </div>
    </div>
</form>

<script>
    document.getElementById('tanggal_transaksi').valueAsDate = new Date();
    const formRows = document.getElementById("formRows");
    const addRowBtn = document.getElementById("addRowBtn");
    let rowIndex = 1;

    const formatRupiah = (angka) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    };


    function addRow() {
        const row = document.createElement("div");
        row.classList.add("row", "mb-2");
        row.innerHTML = `
        <div class="col-4">
            <select name="getBarang[${rowIndex}]" class="form-select select-barang" required>
                <option value="">Pilih Barang</option>
                @foreach($getBarang as $item)
                    <option value="{{ $item->id }}" data-harga_barang="{{ $item->harga }}">
                        {{ $item->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <input class="form-control harga_barang" type="number" name="harga_barang[${rowIndex}]" readonly placeholder="Harga">
        </div>
        <div class="col-2">
            <input class="form-control quantity" type="number" name="quantity[${rowIndex}]" placeholder="Quantity">
        </div>
        <div class="col-2">
            <input type="number" class="form-control item-total" id="item-total" name="item-total" readonly placeholder="Rp 0">
        </div>
        <div class="col-2">
            <button class="btn btn-md btn-danger w-100" type="button" onclick="removeRow(this)">Hapus</button>
        </div>
    `;
        formRows.appendChild(row);
        rowIndex++;
    }

    function removeRow(el) {
        el.closest(".row").remove();
        updateTotals();
    }

    // ketika barang dipilih, isi harga otomatis
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('select-barang')) {
            let harga_barang = e.target.selectedOptions[0].getAttribute('data-harga_barang');
            e.target.closest('.row').querySelector('.harga_barang').value = harga_barang;
            updateTotals();
        }
    });

    // ketika quantity berubah, hitung ulang
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('quantity')) {
            updateTotals();
        }
    });

    function updateTotals() {
        let grandTotal = 0;
        document.querySelectorAll('#formRows .row').forEach(row => {
            const price = parseFloat(row.querySelector('.harga_barang').value) || 0;
            const qty = parseFloat(row.querySelector('.quantity').value) || 0;
            const total = price * qty;
            row.querySelector('.item-total').setAttribute('placeholder', formatRupiah(total));
            grandTotal += total;
        });
        document.querySelector('#grand-total').setAttribute('placeholder', formatRupiah(grandTotal));
    }

    // load awal: tambah satu row
    addRow();
    addRowBtn.addEventListener('click', addRow);
</script>
@endsection