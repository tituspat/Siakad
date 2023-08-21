<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pdf_path', 'kelas_id', 'judul_tugas', 'text'
   ];

    protected $table = 'tugas';
}
