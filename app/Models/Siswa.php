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
}
