<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_layanan',
        'tanggal_booking',
        'waktu_mulai',
        'waktu_selesai',
        'keperluan',
        'status',
        'catatan_penanggung_jawab',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function masterAlat()
    {
        return $this->belongsTo(MasterAlat::class);
    }
}
