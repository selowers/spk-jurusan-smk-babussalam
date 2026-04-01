<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSAW extends Model
{
    use HasFactory;

    protected $table = 'hasil_SAW';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_siswa',
        'id_jurusan',
        'nilai_preferensi',
        'peringkat'
    ];

    protected $casts = [
        'nilai_preferensi' => 'float',
        'peringkat' => 'integer',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    // Relasi ke jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}