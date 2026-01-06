<?php

namespace App\Http\Controllers;

use App\Models\BarangHeader;
use App\Models\PegawaiHeader;
use App\Models\TransaksiDetail;
use App\Models\TransaksiHeader;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TransaksiHeader::get();
        // dd($data);
        return view('pages.transaksi.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $getPegawai = PegawaiHeader::all();
        $getBarang = BarangHeader::all();
        // return view('pages.transaksi.input', ['pegawai' => $getPegawai, 'barang' => $getBarang]);
        return view('pages.transaksi.input', compact('getBarang', 'getPegawai'));
        // return view('pages.transaksi.input', [response()->json([
        //     'getPegawai' => PegawaiHeader::all(),
        //     'getBarang' => BarangHeader::all()
        // ])]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->getBarang);
        // Ambil tanggal transaksi
        $tanggal = $request->tanggal_transaksi;

        // Ambil pegawai
        $pegawaiId = $request->inputGroupSelect01;

        // Ambil semua item
        $barangId   = $request->getBarang;      // array of barang IDs
        $hargaBarang = $request->harga_barang;   // array of harga
        $quantitys  = $request->quantity;       // array of qty

        $grandTotal = 0;
        $items = [];

        // Loop semua item
        foreach ($barangId as $index => $barangId) {
            $harga = isset($hargaBarang[$index]) ? (int)$hargaBarang[$index] : 0;
            $qty   = isset($quantitys[$index]) ? (int)$quantitys[$index] : 0;
            $total = $harga * $qty;

            $items[] = [
                'barang_id' => $barangId,
                'harga'     => $harga,
                'qty'       => $qty,
                'total'     => $total,
            ];

            $grandTotal += $total;
        }

        // Simpan transaksi ke database
        $transaksi = TransaksiHeader::create([
            'tanggal_transaksi' => $tanggal,
            'pegawai_id'        => $pegawaiId,
            'grand_total'       => $grandTotal,
        ]);

        // Simpan detail transaksi
        foreach ($items as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'barang_id'    => $item['barang_id'],
                'harga'        => $item['harga'],
                'qty'          => $item['qty'],
                'total'        => $item['total'],
            ]);
        }

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
