<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\PegawaiHeader;
use App\Models\TransaksiDetail;
use App\Models\TransaksiHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataHeader = TransaksiHeader::get();
        $dataDetails = TransaksiDetail::get();
        // dd($data);
        return view('pages.transaksi.index', compact('dataHeader', 'dataDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $getPegawai = Pegawai::all();
        $getBarang = Barang::all();
        return view('pages.transaksi.input', compact('getBarang', 'getPegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        // Ambil tanggal transaksi
        $tanggal = $request->tanggal_transaksi;
        // dd($request);
        // Ambil pegawai
        $pegawaiId = $request->getPegawai;

        // Ambil semua item
        $barangId   = $request->getBarang;      // array of barang IDs
        $hargaBarang = $request->harga_barang;   // array of harga
        $quantitys  = $request->quantity;       // array of qty

        // dd($barangId);

        $grandTotal = 0;
        $items = [];

        // Loop semua item
        foreach ($barangId as $index => $barangId) {
            $harga = isset($hargaBarang[$index]) ? (int)$hargaBarang[$index] : 0;
            $qty   = isset($quantitys[$index]) ? (int)$quantitys[$index] : 0;
            $total = $harga * $qty;

            $items[] = [
                'barang_id' => $barangId,
                // 'nama_barang' => $barangId,
                'harga'     => $harga,
                'quantity'       => $qty,
                'total'     => $total,
            ];

            $grandTotal += $total;
        }
        // dd($items);


        // // Simpan transaksi ke database
        $transaksi = TransaksiHeader::create([
            'kode_transaksi' => rand(0, 100),
            'tanggal' => $tanggal,
            'pegawai_id'        => $pegawaiId,
            'grandtotal_harga'       => $grandTotal,
        ]);

        // dd($transaksi);
        // // Simpan detail transaksi
        foreach ($items as $item) {

            $transdetail = TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'barang_id'    => $item['barang_id'],
                // 'harga_barang'        => $item['harga'],
                'jumlah'          => $item['quantity'],
                'harga'        => $item['harga'],
            ]);
        }

        // dd($transdetail);

        return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiHeader $transaksiHeader)
    {
        //        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $db = TransaksiHeader::findOrFail($id);

        return view('/pages.transaksi.edit', ['data' => $db]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiHeader $transaksiHeader)
    {
        $affected = TransaksiHeader::where('id', $request->id)
            ->update([
                'nama_barang' => $request->nama_barang,
                // 'updated_at' => now()
            ]);

        return redirect('/transaksi');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiHeader $transaksiHeader)
    {
        //
    }
}
