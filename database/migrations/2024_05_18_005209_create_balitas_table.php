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
        Schema::create('dt_balita', function (Blueprint $table) {
            $table->string('nik_balita')->primary(); // Menetapkan nik_balita sebagai primary key dan otomatis unik
            $table->string('nama_balita');
            $table->date('tgl_balita');
            $table->string('usia');
            $table->string('nik_ibu');
            $table->string('nama_ibu');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();

            // Menambahkan kunci asing untuk merelasikan dengan tabel ibu
            $table->foreign('nik_ibu')->references('nik_ibu')->on('dt_ibu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_balita');
    }
};
