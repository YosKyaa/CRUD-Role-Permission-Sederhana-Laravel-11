<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;
    public $timestamps = false;
     public $incrementing = false;
    protected $fillable = [
        'id',
        'nama_fakultas',
        'kode_fakultas',
        ];
        public function prodi()
    {
    return $this->hasMany(Prodi::class);
    } 

    public function delete()
        {
        // Hapus semua prodi yang terkait dengan fakultas
        $this->prodis()->delete();

        // Hapus fakultas itu sendiri
        return parent::delete();
        }
}
