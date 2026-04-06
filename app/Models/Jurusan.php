<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';

    protected $fillable = [
        'nama_jurusan',
        'fakultas',
        'perguruan_tinggi'
    ];

    // Relasi dengan hasil SAW
    public function hasilSAW()
    {
        return $this->hasMany(HasilSAW::class, 'id_jurusan', 'id_jurusan');
    }

    // Relasi dengan jurusan kriteria
    public function jurusanKriteria()
    {
        return $this->hasMany(JurusanKriteria::class, 'id_jurusan', 'id_jurusan');
    }
}