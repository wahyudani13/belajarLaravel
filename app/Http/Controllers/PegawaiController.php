<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $elequentORM = Pegawai::get();
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
            'jabatan' => 'required',
            'email' => 'required',
        ], [
            'nama_pegawai.required' => 'Hallow Jangan lupa di isi ini nama pegawainya',
            'jabatan.required' => 'Masa iya, jabatan dia apa?',
            'email.required' => 'Yang ini boleh di isi pake email ya!',
        ]);

        Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
        ]);
        return redirect('/pegawai');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $elequentORM = Pegawai::findOrFail($id);
        // dd($id);
        return view('pages.pegawai.edit', ['data' => $elequentORM]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawaiHeader)
    {
        // validasi data
        $request->validate([
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
        ], [
            'nama_pegawai.required' => 'Hallow Jangan lupa di isi ini nama pegawainya',
            'jabatan.required' => 'Masa iya, jabatan dia apa?',
            'email.required' => 'Yang ini boleh di isi pake email ya!',
        ]);
        // dd($request->id);

        $test = Pegawai::where('id', $request->id)
            ->update([
                'nama_pegawai' => $request->nama_pegawai,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
            ]);


        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        // dd($getData);
        $getData->delete($id);

        return redirect('/pegawai');
    }
}
