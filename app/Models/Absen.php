<?php

namespace App\Models\;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = ['siswa_id', 'tanggal', 'kehadiran_id'];

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa')->withDefault();
    }

    public function kehadiran()
    {
        return $this->belongsTo('App\Models\Kehadiran')->withDefault();
    }

    protected $table = 'absensi_siswa';
}
