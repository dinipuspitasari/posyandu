<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->string('nama');
            // $table->string('email')->unique();
            // $table->string('password');
            // $table->foreignId('id_level')->constrained('levels')->onDelete('cascade'); // relasi FK
            $table->unsignedBigInteger('id_level');
            $table->foreign('id_level')->references('id_level')->on('levels')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
