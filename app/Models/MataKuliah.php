<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = ['kode','nama','sks','id_jurusan'];

    protected $primaryKey = 'kode';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function jurusan() {
        return $this->belongsTo(Jurusan::class,'id_jurusan');
    }
}
