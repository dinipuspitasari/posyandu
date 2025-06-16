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
        // Cek apakah tabel 'users' sudah ada
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('nik', 16)->unique();
                $table->string('no_telp', 15);
                $table->string('alamat');
                $table->string('email')->unique();
                $table->string('password');
                // $table->foreignId('id_level')->constrained('levels')->references('id')->onDelete(action: 'cascade'); // Relasi ke levels
                $table->unsignedBigInteger('id_level');
                $table->foreign('id_level')->references('id_level')->on('levels')->onDelete('cascade');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // Cek apakah tabel 'password_reset_tokens' sudah ada
        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        // Cek apakah tabel 'sessions' sudah ada
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index(); // Relasi ke users
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tabel sesuai urutan untuk menghindari masalah foreign key
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};