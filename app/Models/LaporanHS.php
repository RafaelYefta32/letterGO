<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanHS extends Model
{
    //
    protected $table = 'laporan_hasil_studi';

    protected $fillable = [
        'id',
        'nama_lengkap',
        'nrp',
        'keperluan_pembuatan',
        'id_pengajuan',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }
}
