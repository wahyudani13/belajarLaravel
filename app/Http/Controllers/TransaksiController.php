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
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataHeader = TransaksiHeader::get();
        $dataDetails = TransaksiDetail::get();

        // $dataJoin = DB::table('transaksi_header')
        //     ->join('pegawai', 'transaksi_header.pegawai_id', '=', 'pegawai.id')
        //     ->select('transaksi_header.*', 'pegawai.nama_pegawai')
        //     ->get();

        $dataJoin = TransaksiHeader::join('pegawai', 'transaksi_header.pegawai_id', '=', 'pegawai.id')->orderBy('tanggal', 'desc')->get();


        // $dataJoin = TransaksiHeader::with('pegawai')->get();

        // dd($dataJoin);
        return view('pages.transaksi.index', compact('dataHeader', 'dataDetails', 'dataJoin'));
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
            'transaksi_id' => rand(0, 100),
            'tanggal' => $tanggal,
            'pegawai_id'        => $pegawaiId,
            'grandtotal_harga'       => $grandTotal,
        ]);

        // dd($transaksi->kode_transaksi);
        // // Simpan detail transaksi
        foreach ($items as $item) {

            $transdetail = TransaksiDetail::create([
                'transaksi_id' => $transaksi->transaksi_id,
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
        $dt = TransaksiDetail::where('transaksi_id', $id)->get();
        $getPegawai = Pegawai::all();
        $getBarang = Barang::all();
        // $selectedBarangIds = $db->getBarang->pluck('barang_id')->toArray();

        $query = DB::table('transaksi_detail')
            ->join('transaksi_header', 'transaksi_detail.transaksi_id', '=', 'transaksi_header.transaksi_id')
            ->where('transaksi_header.transaksi_id', '=', $id)->first();

        // dd($dt, $query);

        return view('/pages.transaksi.edit', compact('dt', 'getPegawai', 'getBarang', 'query'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiHeader $transaksiHeader)
    {


        // Ambil semua item
        $barangId   = $request->getBarang;      // array of barang IDs
        $hargaBarang = $request->harga_barang;   // array of harga
        $quantitys  = $request->quantity_barang;       // array of qty
        // dd($request);
        $items = [];
        $grandTotal = 0;

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

        /**
         * Update jika ada, dan buat baru jika tidak ada transaksiheader
         */
        $updateTH = TransaksiHeader::updateOrCreate(
            ['transaksi_id' => $request->transaksi_id],
            ['pegawai_id' => $request->getPegawai, 'grandtotal_harga' => $grandTotal]
        );

        // dd($updateTH);

        /**
         * Update jika ada, dan buat baru jika tidak ada transaksidetail,
         */
        TransaksiDetail::where('transaksi_id', $request->transaksi_id)->delete();

        foreach ($items as $item) {
            $updateTD = TransaksiDetail::updateOrCreate(
                [
                    'transaksi_id' => $request->transaksi_id,
                    'barang_id' => $item['barang_id']
                ],
                [
                    'transaksi_id' => $request->transaksi_id,
                    'barang_id'    => $item['barang_id'],
                    // 'harga_barang'        => $item['harga'],
                    'jumlah'          => $item['quantity'],
                    'harga'        => $item['harga'],
                ]
            );
        }

        // dd($updateTD);

        return redirect('/transaksi');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //

        TransaksiDetail::where('transaksi_id', $id)->delete();
        TransaksiHeader::where('transaksi_id', $id)->delete();

        // dd($request, $id);
        return redirect('/transaksi');
    }
}
