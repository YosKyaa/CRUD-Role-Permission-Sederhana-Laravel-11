<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nama_prodi',
        'kode_prodi',
        'fakultas_id'
    ];
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

}
