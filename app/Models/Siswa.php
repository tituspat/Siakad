<?php

namespace App\Models\;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $fillable = ['no_induk', 'nama_siswa', 'kelas_id', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'id_spp', 'foto'];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas')->withDefault();
    }
    public function spp()
    {
        return $this->belongsTo('App\Models\spp')->withDefault();
    }
    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
    protected $table = 'siswa';
}
