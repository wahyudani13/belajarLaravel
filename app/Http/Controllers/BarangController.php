<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\table_barang;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\RecordNotFoundException;

use function Symfony\Component\Clock\now;

class BarangController extends Controller
{
    public function indexBarang()
    {
        $data = table_barang::get();
        // dd($data);
        return view('pages.viewIndex', ['data' => $data]);
    }

    public function tambahBarang()
    {
        return view('pages.viewTambah');
    }

    // public function insertBarang()
    // {
    //     if (isset($_POST['submit'])) {
    //         $data = [
    //             'nama' => $_POST['nama'],
    //             'quantity' => $_POST['quantity'],
    //             'keterangan' => $_POST['keterangan'],
    //         ];
    //     }
    // }

    public function insertBarang(Request $data)
    {
        //Validasi form harus di isi
        $data->validate([
            'nama' => 'required',
            'quantity' => 'required',
            'keterangan' => 'required',
        ]);

        // ERROR GIMANA CARA NAMPILINNYA??
        // dd($data->errors());

        //memasukkan data kedalam table INSERT
        // DB::table('table_barang')->create([]);
        table_barang::create([
            'nama' => $data->nama,
            'quantity' => $data->quantity,
            'keterangan' => $data->keterangan,
        ]);

        return redirect('/viewIndex');
    }

    public function viewEdit($id)
    {
        /* 
        mencari detail data by id
        ada beberapa cara diantaranya seperti dibawah ini.
        **/
        $db = table_barang::findOrFail($id); // << elequent orm mengembalikan 404 notfound
        // $db = DB::table('table_barang')->find($id); // << query builder mengembalikan nilai null
        // $db = DB::table('table_barang')->where('id', $id)->firstOrFail(); // << campuran mengembalikan 404 notfound

        // dd($db->nama);


        return view('/pages.viewEdit', ['data' => $db]);
    }

    public function putUpdate($id, Request $data)
    {
        //validasi gotcha rescue
        $data->validate([
            'nama' => 'required',
            'quantity' => 'required',
            'keterangan' => 'required',
        ], [
            'nama.required' => 'Hallow Jangan lupa di isi ini nama barangnya',
            'quantity.required' => 'Masa iya, quantity nya dikosongin?',
            'keterangan.required' => 'Yang ini boleh di isi asal aja, tapi harus tetap di isi ya!',
        ]);
        // var_dump($id);

        // $affected = DB::table('table_barang')
        //     ->where('id', $id)
        //     ->update([
        //         'nama' => $data->nama,
        //         'quantity' => $data->quantity,
        //         'keterangan' => $data->keterangan
        //     ]);

        $affected = table_barang::where('id', $id)
            ->update([
                'nama' => $data->nama,
                'quantity' => $data->quantity,
                'keterangan' => $data->keterangan,
                // 'updated_at' => now()
            ]);

        return redirect('/viewIndex');
    }

    public function delete($id)
    {
        // dd($id);
        $deleted = DB::table('table_barang')->where('id', $id)->delete();
        return redirect('/viewIndex');
    }
}
