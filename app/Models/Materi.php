<?php

namespace App\Models\;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'link_video', 'link_materi', 'kelas_id', 'text', ];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas')->withDefault();
    }

    protected $table = 'materi';
}
