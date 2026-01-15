@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>Edit Transaksi</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="/transaksi" type="button" class="btn btn-success">Kembali ke View Transaksi</a>
        </div>
    </div>
    <!-- <div class="row"> -->
    <form action="/transaksi/{{$query->transaksi_id}}" method="POST">
        @method('PUT')
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="transaksi_id" class="form-label">Transaksi ID</label>
                <input type="text" readonly class="form-control" id="transaksi_id" name="transaksi_id" value="{{$query->transaksi_id}}">
            </div>
            <div class="col">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" value="{{$query->tanggal}}">
            </div>
            <div class="col">
                <label for="pegawai" class="form-label">Pegawai</label>
                <select class="form-select" id="getPegawai" name="getPegawai">
                    <option>Pilih Pegawai</option>
                    <option value="{{$query->pegawai_id}}" selected>{{$query->pegawai_id}}</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <h4 class="text-center">
                LIST ITEMS
            </h4>
        </div>
        <div id="formRows"></div>
        @foreach($dt as $detailTransaksi)
        <div id="formRows">
            <div class="row mb-2">
                <div class="col-4">
                    <label for="getBarang" class="form-label">Nama Barang</label>
                    <select name="getBarang[]" class="form-select select-barang">
                        <option value="">
                            Pilih Barang
                        </option>
                        @foreach ($getBarang as $barang)
                        <option value="{{$barang->id}}" data-harga_barang="{{$barang->harga}}"
                            {{ $barang->id == $detailTransaksi->barang_id ? 'selected' : '' }}>
                            {{ $barang->nama_barang }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label for="harga_barang" class="form-label">Harga Barang</label>
                    <input type="text" readonly class="form-control harga_barang" id="harga_barang" name="harga_barang[]" value="{{$detailTransaksi->harga}}">
                </div>
                <div class="col-2">
                    <label for="quantity_barang" class="form-label">Quantity</label>
                    <input type="text" class="form-control quantity_barang" id="quantity_barang" name="quantity_barang[]" value="{{$detailTransaksi->jumlah}}">
                </div>
                <div class="col-2">
                    <label for="item-total" class="form-label">Total</label>
                    <input type="number" class="form-control item-total" id="item-total" name="item-total[]" readonly="" placeholder="Rp 0">
                </div>
                <div class="col-2">
                    <label for="button-hapus" class="form-label">Action</label>
                    <button class="btn btn-md btn-danger w-100" type="button" onclick="removeRow(this)">Hapus</button>
                </div>
            </div>
        </div>
        @endforeach
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
    <!-- </div> -->
</div>

<script>
    const formRows = document.getElementById("formRows");
    const addRowBtn = document.getElementById("addRowBtn");
    let rowIndex = 1;

    /*
    untuk merubah tampilan menjadi Rp. xxx < hanya bisa digunakan pada attribute diplaceholder
    tidak bisa diberikan kepada attribute value
    
    **/
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
                    <label for="getBarang" class="form-label">Nama Barang</label>
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
                    <label for="harga_barang" class="form-label">Harga Barang</label>
                    <input type="text" readonly class="form-control harga_barang" id="harga_barang" name="harga_barang[${rowIndex}]">
                </div>
                <div class="col-2">
                    <label for="quantity_barang" class="form-label">Quantity</label>
                    <input type="text" class="form-control quantity_barang" id="quantity_barang" name="quantity_barang[${rowIndex}]">
                </div>
                <div class="col-2">
                    <label for="item-total" class="form-label">Total</label>
                    <input type="number" class="form-control item-total" id="item-total" name="item-total[]" readonly="" placeholder="Rp 0">
                </div>
                <div class="col-2">
                    <label for="button-hapus" class="form-label">Action</label>
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
        if (e.target.classList.contains('quantity_barang')) {
            updateTotals();
        }
    });

    function updateTotals() {
        let grandTotal = 0;
        document.querySelectorAll('#formRows .row').forEach(row => {
            const price = parseFloat(row.querySelector('.harga_barang').value) || 0;
            const qty = parseFloat(row.querySelector('.quantity_barang').value) || 0;
            const total = price * qty;
            // row.querySelector('.item-total').value = total;
            row.querySelector('.item-total').setAttribute('placeholder', formatRupiah(total));

            grandTotal += total;
            // console.log(document.querySelectorAll('#formRows .row'));
        });
        // document.querySelector('#grand-total').value = grandTotal;
        document.querySelector('#grand-total').setAttribute('placeholder', formatRupiah(grandTotal));
    }

    updateTotals();

    addRowBtn.addEventListener('click', addRow);
</script>
@endsection


<!-- <div class="col-4">
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
    <input class="form-control quantity_barang" type="number" name="quantity[${rowIndex}]" placeholder="Quantity">
</div>
<div class="col-2">
    <input type="number" class="form-control item-total" id="item-total" name="item-total" readonly placeholder="Rp 0">
</div>
<div class="col">
    <button class="btn btn-md btn-danger w-100" type="button" onclick="removeRow(this)">Hapus</button>
</div> -->