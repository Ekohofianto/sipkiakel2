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
        Schema::create('dt_p_ibu', function (Blueprint $table) {
            $table->bigIncrements('id_p_ibu'); // Ini akan membuat kolom auto increment dan primary key
            $table->string('nik_ibu');
            $table->string('nama_ibu');
            $table->decimal('berat_b', 8, 1);
            $table->decimal('tinggi_b', 8, 1);
            $table->string('tekanan_d');
            $table->string('riwayat_p')->nullable();
            $table->decimal('usia_kehamilan', 8, 1)->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('dt_p_ibu');
    }
};
