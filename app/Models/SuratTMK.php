<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTMK extends Model
{
    //
    protected $table = 'surat_tugas_mk';

    protected $fillable = [
        'id',
        'tujuan_instansi',
        'periode',
        'data_mahasiswa',
        'tujuan',
        'topik',
        'id_pengajuan',
        'kode_mk',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }

    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class, 'kode_mk');
    }
}
