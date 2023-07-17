<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;

class detailKegiatan extends Model
{
    use HasFactory;

    protected $table = 'detailkegiatans';

    protected $with = ['kegiatans'];

    protected $fillable = [
        'id_kegiatan',
        'kegiatan',
        'hasil'
    ];

    public function kegiatans()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}
