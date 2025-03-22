<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKL extends Model
{
    //
    protected $table = 'surat_keterangan_lulus';

    protected $fillable = [
        'id',
        'nama_lengkap',
        'nrp',
        'tanggal_lulus',
        'id_pengajuan',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }
}
