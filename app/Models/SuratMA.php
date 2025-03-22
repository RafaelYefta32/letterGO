<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMA extends Model
{
    //
    protected $table = 'surat_mahasiswa_aktif';

    protected $fillable = [
        'id',
        'nama_lengkap',
        'nrp',
        'periode',
        'alamat',
        'keperluan_pengajuan',
        'id_pengajuan',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }
}
