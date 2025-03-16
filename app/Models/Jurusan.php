<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $primaryKey = 'kode';

    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama'
    ];

    public $incrementing = false;

    public $timestamps = false;


}
