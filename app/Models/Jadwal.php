<?php

namespace App\Models\;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
  use SoftDeletes;

  protected $fillable = ['hari_id', 'kelas_id', 'guru_id', 'jam_mulai', 'jam_selesai'];

  public function hari()
  {
    return $this->belongsTo('App\Models\Hari')->withDefault();
  }

  public function kelas()
  {
    return $this->belongsTo('App\Models\Kelas')->withDefault();
  }

  public function guru()
  {
    return $this->belongsTo('App\Models\Guru')->withDefault();
  }

  public function rapot($id)
  {
    $kelas = Kelas::where('id', $id)->first();
    return $kelas;
  }

  public function pengajar($id)
  {
    $guru = Guru::where('id', $id)->first();
    return $guru;
  }

  public function absen($id)
  {
    $absen = Absen::where('tanggal', date('Y-m-d'))->where('guru_id', $id)->first();
    if ($absen && $absen['kehadiran_id']) {
      $ket = Kehadiran::where('id', $absen['kehadiran_id'])->first();
      return $ket['color'];
    } else {
      return false;
    }
  }

  protected $table = 'jadwal';
}
