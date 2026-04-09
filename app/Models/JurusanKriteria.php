
<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurusanKriteria extends Model
{
    protected $table = 'jurusan_kriteria';
    protected $primaryKey = 'id_jurusan_kriteria';
    protected $fillable = ['id_jurusan', 'id_kriteria', 'nilai'];
    protected $casts = [
        'nilai' => 'float',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
