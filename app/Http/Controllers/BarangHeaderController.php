<?php

namespace App\Http\Controllers;

use App\Models\BarangHeader;
use Illuminate\Http\Request;

class BarangHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elequentORM = BarangHeader::get();
        // dd($elequentORM->all());
        return view('pages.barang.index', ['data' => $elequentORM]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.barang.insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'keterangan_barang' => 'required',
        ], [
            'nama_barang.required' => 'Hallow Jangan lupa di isi ini nama barangnya',
            'harga_barang.required' => 'Masa iya, harga barang nya dikosongin?',
            'keterangan_barang.required' => 'Yang ini boleh di isi asal aja, tapi harus tetap di isi ya!',
        ]);

        $elequentORM = BarangHeader::create([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'keterangan_barang' => $request->keterangan_barang,
        ]);
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangHeader $barangHeader)
    {
        //
        dd("ini barang" . BarangHeader::findOrFail($barangHeader->id));
        // $barangHeader = BarangHeader::findOrFail($id);
        return view('pages.barang.edit', compact('barangHeader'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $elequentORM = BarangHeader::findOrFail($id);
        // dd($id);
        return view('pages.barang.edit', ['data' => $elequentORM]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangHeader $barangHeader)
    {
        //
        //validasi gotcha rescue
        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'keterangan_barang' => 'required',
        ], [
            'nama_barang.required' => 'Hallow Jangan lupa di isi ini nama barangnya',
            'harga_barang.required' => 'Masa iya, harga barang nya dikosongin?',
            'keterangan_barang.required' => 'Yang ini boleh di isi asal aja, tapi harus tetap di isi ya!',
        ]);
        // var_dump($id);

        // $affected = DB::table('table_barang')
        //     ->where('id', $id)
        //     ->update([
        //         'nama' => $data->nama,
        //         'quantity' => $data->quantity,
        //         'keterangan' => $data->keterangan
        //     ]);

        BarangHeader::where('id', $request->id)
            ->update([
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'keterangan_barang' => $request->keterangan_barang,
                // 'updated_at' => now()
            ]);

        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $getData = BarangHeader::find($id);
        // dd($getData);
        $getData->delete($id);
        return redirect('/barang');
    }
}
