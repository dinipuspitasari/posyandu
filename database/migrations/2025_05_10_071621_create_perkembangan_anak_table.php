<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkembanganAnakTable extends Migration
{
    public function up()
    {
        Schema::create('perkembangan_anak', function (Blueprint $table) {
            // $table->unsignedBigInteger('id_perkembangan_anak')->autoIncrement()->primary();
            $table->id('id_perkembangan_anak');
            $table->string('nama_anak');
            $table->string('nik_anak');
            $table->date('tanggal_posyandu');
            $table->float('berat_badan'); //dalam kg
            $table->enum('keterangan_berat_badan', ['N', 'T', 'O', 'B']); // Naik berat badan, Tidak naikatau tetap, Bulan lalu tidak menimbang, Baru pertama kali datang
            $table->float('tinggi_badan'); //dalam cm
            $table->float('lingkar_lengan_atas')->nullable(); //dalam cm
            $table->float('lingkar_kepala')->nullable(); //dalam cm
            $table->unsignedBigInteger('id_imunisasi')->nullable();
            $table->enum('pemberian', ['Vitamin A', 'Obat Cacing'])->nullable();
            $table->enum('mt_pangan_lokal', ['Y', 'T']);
            $table->enum('asi_eksklusif', ['Y', 'T'])->nullable();
            $table->foreign('id_imunisasi', 'fk_perkembangan_imunisasi')->references('id_imunisasi')->on('imunisasi')->onDelete('set null');
            $table->timestamps();

            // Foreign key constraints
            $table->unsignedBigInteger('id_data_anak');
            $table->foreign('id_data_anak')->references('id_data_anak')->on('data_anak')->onDelete('cascade');

            // $table->foreign('id_data_anak')->references('id_data_anak')->on('data_anak')->onDelete('cascade');
            $table->foreign('id_imunisasi')->references('id_imunisasi')->on('imunisasi')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('perkembangan_anak');
    }
}
