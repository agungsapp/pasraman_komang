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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenjang_id')->constrained('jenjangs');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas');
            $table->string('nama');
            $table->string('email');
            $table->string('no_orang_tua');
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
