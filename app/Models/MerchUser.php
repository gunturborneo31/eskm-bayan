<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchUser extends Model
{
    use HasFactory;

    protected $table = 'merch_users';
    protected $fillable = ['username','password','name'];
    protected $hidden = ['password'];
}
