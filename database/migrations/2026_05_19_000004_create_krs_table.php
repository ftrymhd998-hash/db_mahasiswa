<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsTable extends Migration
{
    public function up()
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
            $table->string('semester');
            $table->string('nilai', 2)->nullable();
            $table->timestamps();

            $table->unique(['mahasiswa_id', 'mata_kuliah_id', 'semester']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('krs');
    }
}
