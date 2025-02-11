<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $fillable = ['nama', 'id_jenis', 'id_kota', 'alamat', 'lat', 'long'];
}
