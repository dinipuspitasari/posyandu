<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataOrangTuaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_orang_tua', function (Blueprint $table) {
            // $table->bigIncrements('id_data_orang_tua'); // primary key custom nama
            $table->id('id_data_orang_tua');
            $table->string('nik_ibu', 16)->unique();
            $table->string('nama_ibu');
            $table->string('no_telpon');
            $table->text('alamat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_orang_tua');
    }
}
