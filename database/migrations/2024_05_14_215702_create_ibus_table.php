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
        Schema::create('dt_ibu', function (Blueprint $table) {
            $table->string('nik_ibu')->primary(); // Menetapkan nik_ibu sebagai primary key dan otomatis unik
            $table->string('nama_ibu');
            $table->date('tgl_ibu');
            $table->integer('usia');
            $table->string('nama_suami')->nullable();
            $table->string('alamat');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_ibu');
    }
};
