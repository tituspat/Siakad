<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soal', function (Blueprint $table) {

                $table->id();
                $table->text('pertanyaan');
                $table->string('pilihan_a');
                $table->string('pilihan_b');
                $table->string('pilihan_c');
                $table->string('pilihan_d');
                $table->char('jawaban_benar', 1);


                $table->string('id_test');
                $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
