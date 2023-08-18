<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_test', 'kelas_id'
   ];

   public function ulangan()
   {
       return $this->belongsTo('App\Models\Kelas')->withDefault();
   }

    protected $table = 'test';
}
