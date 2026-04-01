<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nama_siswa',
        'kelas',
        'jurusan_sekolah',
        'tahun_ajaran',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_siswa', 'id_siswa');
    }

    // Relasi dengan hasil SAW
    public function hasilSAW()
    {
        return $this->hasMany(HasilSAW::class, 'id_siswa', 'id_siswa');
    }
}
