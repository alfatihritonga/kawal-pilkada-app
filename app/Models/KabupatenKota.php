<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }
}
