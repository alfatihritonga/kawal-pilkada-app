<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelurahanDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kecamatan_id',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function tps()
    {
        return $this->hasMany(TPS::class);
    }
}
