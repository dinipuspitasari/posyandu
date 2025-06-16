<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAnakTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_anak', function (Blueprint $table) {
            // $table->bigIncrements('id_data_anak'); 
            $table->id('id_data_anak');
            $table->string('nik_anak', 16)->unique();
            $table->string('nama_ibu'); // Opsional, karena seharusnya relasi ambil dari orang tua
            $table->string('nama_anak');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('umur')->nullable(); // Bisa dihitung dari tanggal lahir
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('detail_anak')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('id_data_orang_tua')->nullable();
            $table->foreign('id_data_orang_tua')
                  ->references('id_data_orang_tua') // Harus sesuai dengan PK tabel orang tua
                  ->on('data_orang_tua')
                  ->onDelete('set null');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_anak');
    }
}
