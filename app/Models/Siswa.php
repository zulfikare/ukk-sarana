<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $nis
 * @property string|null $nama
 * @property string|null $kelas
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Siswa extends Model
{
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nis', 'nama', 'kelas', 'keterangan', 'username', 'password'];

    public function getRouteKeyName()
    {
        return 'nis';
    }
}
