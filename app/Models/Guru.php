<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_card', 'nip', 'nama_guru', 'kode', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto'];

    public function dsk($id)
    {
        $dsk = Nilai::where('guru_id', $id)->first();
        return $dsk;
    }

    protected $table = 'guru';
}
