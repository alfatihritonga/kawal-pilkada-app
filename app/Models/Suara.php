<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suara extends Model
{
    use HasFactory;

    protected $fillable = [
        'suara_darwis',
        'suara_baharuddin',
        'suara_zahir',
        'status',
        'tps_id',
        'user_id',
        'form_c1',
    ];

    public function tps()
    {
        return $this->belongsTo(Tps::class, 'tps_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
