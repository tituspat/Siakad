<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['no_induk', 'id_test', 'nilai'];

    public function test()
    {
        return $this->belongsTo('App\Models\test')->withDefault();
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa')->withDefault();
    }

    protected $table = 'nilai';
}
