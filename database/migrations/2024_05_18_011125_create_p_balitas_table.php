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
        Schema::create('dt_p_balita', function (Blueprint $table) {
            $table->bigIncrements('id_p_balita'); // Ini akan membuat kolom auto increment dan primary key
            $table->string('nik_balita');
            $table->string('nama_balita');
            $table->decimal('berat_badan', 8, 1);
            $table->decimal('panjang_badan', 8, 1);
            $table->decimal('lingkar_kepala', 8, 1);
            $table->decimal('lingkar_lengan', 8, 1);
            $table->string('jenis_imunisasi');
            $table->string('alamat')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();

            // Menambahkan kunci asing untuk merelasikan dengan tabel ibu
            $table->foreign('nik_balita')->references('nik_balita')->on('dt_balita')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_p_balita');
    }
};
