<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = ['ket', 'color'];

    protected $table = 'kehadiran';
}
