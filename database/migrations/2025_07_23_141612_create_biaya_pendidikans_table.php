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
        Schema::create('biaya_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenjang_id')->constrained('jenjangs');
            $table->foreignId('komponen_biaya_id')->constrained('komponen_biayas');
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_pendidikans');
    }
};
