<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    //
    protected $table = 'pengajuan_surat';
    
    protected $fillable = [
        'id',
        'nrp',
        'mo_nik',
        'kaprodi_nik',
        'jenis_surat',
        'status',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'file_surat',
        'tanggal_upload',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function mahasiswa() {
        return $this->belongsTo(User::class, 'nrp');
    }

    public function mo() {
        return $this->belongsTo(User::class, 'mo_nik');
    }

    public function kaprodi() {
        return $this->belongsTo(User::class, 'kaprodi_nik');
    }

}
