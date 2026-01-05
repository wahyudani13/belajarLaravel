<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiHeader extends Model
{
    // pemilihan ingin guarded atau fillable, karena lebih sedikit guarded maka kita akan menggunakan guarded

    protected $guarded = ['id'];
}
