<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kabupaten_kota_id',
    ];

    public function kabupatenKota()
    {
        return $this->belongsTo(KabupatenKota::class);
    }

    public function kelurahanDesas()
    {
        return $this->hasMany(KelurahanDesa::class);
    }

    public function dpt()
    {
        return $this->hasMany(DptKecamatan::class);
    }
}
