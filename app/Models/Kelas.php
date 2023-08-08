<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = ['paket_id', 'nama_kelas', 'guru_id'];

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru')->withDefault();
    }

    public function paket()
    {
        return $this->belongsTo('App\Models\Paket')->withDefault();
    }

    protected $table = 'kelas';
}
