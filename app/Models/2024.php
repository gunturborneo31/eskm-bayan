<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tahun_2024 extends Model
{

    use HasFactory;
    public $table = "survey_responses";
    protected $where = ['tahun' => 2024];

    protected $fillable = [
            'nama' ,
            'alamat' ,
            'pekerjaan' ,
            'jenkel' ,
            'usia' ,
            'nohp' ,
            'pendidikan' ,
            'nik' ,
            'u1' ,
            'u2' ,
            'u3' ,
            'u4' ,
            'u5' ,
            'u6' ,
            'u7' ,
            'u8' ,
            'u9' ,
            'saran' ,
    ];
}
