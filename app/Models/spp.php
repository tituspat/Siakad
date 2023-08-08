<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    use HasFactory;

    protected $table = 'spp';
   
    protected $fillable = [
         'tahun', 'nominal'
    ];
   
    /**
   * Belongs To Spp -> User
   *
   * @return void
   */
   public function siswa()
   {
    return $this->belongsTo('App\Models\Siswa')->withDefault();
   }
}
