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
    public function show(PegawaiHeader $pegawaiHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PegawaiHeader $pegawaiHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PegawaiHeader $pegawaiHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PegawaiHeader $pegawaiHeader)
    {
        //
    }
}
