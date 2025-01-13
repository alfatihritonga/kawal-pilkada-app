<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'password',
        'nama',
        'alamat',
        'nomor_hp',
        'kecamatan_id',
        'role',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
