@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row text-center justify-content-between">
        <div class="col-6 pull-left">
            <h1>Input Transaksi</h1>
        </div>
        <div class="col-3 pull-right">
            <a href="#" type="button" class="btn btn-success">Kembali Ke Menu</a>
        </div>
    </div>
    <!-- <div class="row"> -->
    <form action="#" method="post">
        @method('PUT')
        @csrf
        <div class="row mb-3">
            <label for="id" class="form-label">ID Transaksi</label>
            <input type="text" class="form-control" id="id" name="id" placeholder="AUTO INCREMENT" readonly>
        </div>
        <div class="row mb-3">
            <select class="form-select" id="inputGroupSelect01">
                <option selected>Pilih Pegawai</option>
                @foreach($getPegawai as $row)
                <option value="{{$row->nama_pegawai}}">{{$row->nama_pegawai}}</option>
                @endforeach
            </select>
        </div>
        <div class="row mb-3">
            <h4 class="text-center">
                MASUKKAN ITEM
            </h4>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <select class="form-select" id="inputBarang1">
                    <option selected>Pilih Barang</option>
                    @foreach($getBarang as $row)
                    <option value="{{$row->id}}">{{$row->nama_barang}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <input type="number" class="form-control" placeholder="Harga">
            </div>
            <div class="col-3">
                <input type="number" class="form-control" placeholder="Quantity">
            </div>
            <div class="col-1">
                <button class="btn btn-sm btn-primary" type="button" onclick="add()">Tambah Item</button>
            </div>
            <div class="col-1">
                <button class="btn btn-sm btn-danger" type="button">Hapus Item</button>
            </div>
        </div>
        <div class="row mb-3" id="inputFields"></div>
        <div class="row mb-3">
            <input type="submit" class="btn btn-lg btn-primary pull-right" name="submit" value="Add">
            <a href="/pegawai" type="button" class="ml-3 btn btn-lg btn-danger">Batalkan</a>
        </div>
    </form>
</div>
<script>
    count = 2;
    const barang = @json($getBarang);
    const pegawai = @json($getPegawai);

    function add() {
        const divEle = document.getElementById("inputFields");
        //generate kolom select barang
        const wrapper = document.createElement("div");
        wrapper.classList.add("col-4", "mb-3");

        // elemen select
        const select = document.createElement("select");
        select.classList.add("form-select");
        select.setAttribute("id", "inputGroupSelect" + count);

        // option pertama
        const option = document.createElement("option");
        option.textContent = "Pilih Barang";
        select.appendChild(option);

        barang.forEach(item => {
            const option = document.createElement("option");
            // option.value = item.id;              // value dari id barang
            option.setAttribute("value", item.id);
            option.setAttribute("id", "hargaInput" + count)
            option.setAttribute("data-harga", item.harga_barang);
            option.textContent = item.nama_barang; // teks dari nama_barang
            select.appendChild(option);

        });


        // masukkan select ke wrapper
        wrapper.appendChild(select);

        // masukkan wrapper ke div utama
        divEle.appendChild(wrapper);

        // generate kolom harga
        const wrapper2 = document.createElement("div");
        wrapper2.classList.add("col-3", "mb-3");

        const input1 = document.createElement('input');
        input1.classList.add("form-control");
        input1.setAttribute("name", "harga_barang" + count)
        input1.setAttribute("id", "harga_barang" + count)
        input1.setAttribute("type", "number");
        input1.setAttribute("placeholder", "Harga");

        //masukan input ke div wrapper
        wrapper2.appendChild(input1);

        // masukkan wrapper ke div utama
        divEle.appendChild(wrapper2);

        //generate kolom quantity
        const wrapper3 = document.createElement("div");
        wrapper3.classList.add("col-3", "mb-3");

        const input2 = document.createElement('input');
        input2.classList.add("form-control");
        input2.setAttribute("name", "quantity" + count)
        input2.setAttribute("id", "quantity" + count)
        input2.setAttribute("type", "number");
        input2.setAttribute("placeholder", "Quantity");

        //masukan input ke div wrapper
        wrapper3.appendChild(input2);

        // masukkan wrapper ke div utama
        divEle.appendChild(wrapper3);
        count++;

    }
</script>
@endsection