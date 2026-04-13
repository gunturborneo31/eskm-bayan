<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BagianLayanan extends Model
{
    protected $table = 'bagian_layanan';

    protected $fillable = [
        'nama',
        'kode',
        'is_active',
    ];
}
