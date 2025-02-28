<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wisata extends Model
{
    // protected $guarded = ['id'];
    protected $fillable = ['nama', 'id_jenis', 'id_kota', 'alamat', 'lat', 'long'];

    public function jenis(): BelongsTo
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class, 'id_kota');
    }
}
