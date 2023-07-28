<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detailKegiatan;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'id_user',
        'tanggal',
        'kegiatan',
        'hasil'
    ];

    public function detailkegiatans()
    {
        return $this->hasMany(detailKegiatan::class, 'id_kegiatan');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_kegiatan');
    }
}
