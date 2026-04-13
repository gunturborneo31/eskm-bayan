<?php

// app/Models/SubJenis.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubJenis extends Model
{
    protected $table = 'sub_jenis';
    protected $fillable = ['bagian', 'bidang', 'jenis'];
}
