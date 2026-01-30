<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_pelaporan
 * @property int $nis
 * @property int $id_kategori
 * @property string|null $lokasi
 * @property string|null $ket
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class InputAspirasi extends Model
{
    protected $primaryKey = 'id_pelaporan';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = ['id_pelaporan', 'nis', 'id_kategori', 'lokasi', 'ket'];

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
        return 'id_pelaporan';
    }
}
