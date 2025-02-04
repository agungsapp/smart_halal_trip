<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    protected $fillable = ['nama'];

    public function wisata(): HasMany
    {
        return $this->hasMany(Wisata::class, 'id_jenis');
    }
}
