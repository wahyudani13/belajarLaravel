<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_barang extends Model
{
    // insialisasi
    // protected $seed = true;

    protected $table = 'table_barang';
    protected $primaryKey = 'id';

    // fillable menentukan kolom yang mana yang boleh di isi

    // protected $fillable = ['nama', 'quantity', 'keterangan'];

    // guarded menentukan kolom yang mana yang tidak boleh di isi

    protected $guarded = ['id'];

    // HANYA GUNAKAN SALAH SATU ANTARA FILLABLE ATAU GUARDED!!!
}
