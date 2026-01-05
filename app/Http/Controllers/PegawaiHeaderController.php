<?php

namespace App\Http\Controllers;

use App\Models\PegawaiHeader;
use Illuminate\Http\Request;

class PegawaiHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $elequentORM = PegawaiHeader::get();
        return view('pages.pegawai.index', ['data' => $elequentORM]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('pages.pegawai.insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi
        $request->validate([
            'nama_pegawai' => 'required',
            'jabatan_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'usia_pegawai' => 'required',
        ], [
            'nama_pegawai.required' => 'Hallow Jangan lupa di isi ini nama barangnya',
            'jabatan_pegawai.required' => 'Masa iya, harga barang nya dikosongin?',
            'alamat_pegawai.required' => 'Yang ini boleh di isi asal aja, tapi harus tetap di isi ya!',
            'usia_pegawai.required' => 'Usia kamu berapa saat ini?',
        ]);

        PegawaiHeader::create([
            'nama_pegawai' => $request->nama_pegawai,
            'jabatan_pegawai' => $request->jabatan_pegawai,
            'alamat_pegawai' => $request->alamat_pegawai,
            'usia_pegawai' => $request->usia_pegawai,
        ]);
        return redirect('/pegawai');
    }

    /**
     * Display the specified resource.
     */
    public function show(PegawaiHeader $pegawaiHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $elequentORM = PegawaiHeader::findOrFail($id);
        // dd($id);
        return view('pages.pegawai.edit', ['data' => $elequentORM]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PegawaiHeader $pegawaiHeader)
    {
        // validasi data
        $request->validate([
            'nama_pegawai' => 'required',
            'jabatan_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'usia_pegawai' => 'required',
        ], [
            'nama_pegawai.required' => 'Hallow Jangan lupa di isi ini nama barangnya',
            'jabatan_pegawai.required' => 'Masa iya, harga barang nya dikosongin?',
            'alamat_pegawai.required' => 'Yang ini boleh di isi asal aja, tapi harus tetap di isi ya!',
            'usia_pegawai.required' => 'Usia kamu berapa saat ini?',
        ]);
        // dd($request->id);

        $test = PegawaiHeader::where('id', $request->id)
            ->update([
                'nama_pegawai' => $request->nama_pegawai,
                'jabatan_pegawai' => $request->jabatan_pegawai,
                'alamat_pegawai' => $request->alamat_pegawai,
                'usia_pegawai' => $request->usia_pegawai,
            ]);


        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $getData = PegawaiHeader::find($id);
        // dd($getData);
        $getData->delete($id);

        return redirect('/pegawai');
    }
}
