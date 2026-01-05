<?php

namespace App\Http\Controllers;

use App\Models\BarangHeader;
use App\Models\PegawaiHeader;
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
        //
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
