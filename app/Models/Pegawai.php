<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // pemilihan ingin guarded atau fillable, karena lebih sedikit guarded maka kita akan menggunakan guarded
    protected $table = "pegawai";

    protected $guarded = ['id'];


}
