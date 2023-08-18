<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $fillable = ['pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar', 'id_test'];

    public function test()
    {
        return $this->belongsTo('App\Models\test')->withDefault();
    }

    protected static function boot()
    {
        parent::boot();

        // Event handler untuk mengubah jawaban_benar menjadi huruf kapital sebelum disimpan
        self::saving(function ($model) {
            $model->jawaban_benar = strtoupper($model->jawaban_benar);
        });
    }

    protected $table = 'soal';
}
