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
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul');

            $table->string('link_video')->nullable();
            $table->string('link_materi')->nullable();
            $table->integer('kelas_id')->nullable();
            
            $table->text('text')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
