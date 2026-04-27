<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAlat extends Model
{
    protected $table = 'master_alat';

    protected $fillable = [
        'nama_alat',
        'kategori',
        'deskripsi',
        'jumlah',
        'kondisi',
        'foto',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
