<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_kategori
 * @property string $ket_kategori
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = ['id_kategori', 'ket_kategori'];

    public function getRouteKeyName()
    {
        return 'id_kategori';
    }
}
