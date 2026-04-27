<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    
    protected $fillable = [
        'user_id',
        'master_alat_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_kembali_realisasi',
        'keperluan',
        'status',
        'catatan_penanggung_jawab',
        'kondisi_alat_kembali',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_kembali_realisasi' => 'date',
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
