<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_aspirasi
 * @property string|null $nama
 * @property int $id_kategori
 * @property string $status
 * @property int|null $feedback
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Pengaduan extends Model
{
    protected $table = 'aspirasis';
    protected $primaryKey = 'id_aspirasi';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = ['id_aspirasi', 'nama', 'nis', 'id_kategori', 'lokasi', 'ket', 'gambar', 'status', 'feedback'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function getRouteKeyName()
    {
        return 'id_aspirasi';
    }
}
