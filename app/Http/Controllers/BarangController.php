<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elequentORM = Barang::get();
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
            // 'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ], [
            // 'kode_barang.required' => 'Hallow Jangan lupa di isi ini kode barangnya',
            'nama_barang.required' => 'Hallow Jangan lupa di isi ini nama barangnya',
            'harga.required' => 'Masa iya, harga barang nya dikosongin?',
            'stok.required' => 'Yang ini boleh di isi asal aja, tapi harus tetap di isi ya!',
        ]);

        $elequentORM = Barang::create([
            'kode_barang' => Str::random(20),
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
        Barang::findOrFail($barang->id);
        // $barangHeader = BarangHeader::findOrFail($id);
        return view('pages.barang.edit', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $elequentORM = Barang::findOrFail($id);
        // dd($id);
        return view('pages.barang.edit', ['data' => $elequentORM]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //
        //validasi gotcha rescue
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ], [
            'kode_barang.required' => 'Hallow Jangan lupa di isi ini kode barangnya',
            'nama_barang.required' => 'Hallow Jangan lupa di isi ini nama barangnya',
            'harga.required' => 'Masa iya, harga barang nya dikosongin?',
            'stok.required' => 'Yang ini boleh di isi asal aja, tapi harus tetap di isi ya!',
        ]);
        // var_dump($id);

        // $affected = DB::table('table_barang')
        //     ->where('id', $id)
        //     ->update([
        //         'nama' => $data->nama,
        //         'quantity' => $data->quantity,
        //         'keterangan' => $data->keterangan
        //     ]);

        Barang::where('id', $request->id)
            ->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
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
        $getData = Barang::find($id);
        // dd($getData);
        $getData->delete($id);
        return redirect('/barang');
    }
}
