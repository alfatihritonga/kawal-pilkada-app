<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'kelurahan_desa_id',
    ];
    
    public function kelurahanDesa()
    {
        return $this->belongsTo(KelurahanDesa::class);
    }
    
    public function suara()
    {
        return $this->hasMany(Suara::class, 'tps_id');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tps', 'tps_id', 'user_id');
    }
    
}
