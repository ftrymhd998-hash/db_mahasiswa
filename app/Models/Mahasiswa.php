<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'prodi_id',
        'npm',
        'nama_lengkap',
        'alamat',
        'email',
        'telpon',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function mataKuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'krs')
            ->withPivot('semester', 'nilai')
            ->withTimestamps();
    }
}
