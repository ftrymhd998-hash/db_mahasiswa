<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProdiIdToMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreignId('prodi_id')->nullable()->after('id')
                  ->constrained('prodi')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropConstrainedForeignId('prodi_id');
        });
    }
}
