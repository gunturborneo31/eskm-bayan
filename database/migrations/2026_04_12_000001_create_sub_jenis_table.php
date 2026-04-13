<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('sub_jenis')) {
            return;
        }

        Schema::create('sub_jenis', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('bagian');
            $table->string('bidang');
            $table->string('jenis');
            $table->timestamps();

            $table->index(['bagian', 'bidang']);
            $table->unique(['bagian', 'bidang', 'jenis'], 'sub_jenis_unique_triplet');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_jenis');
    }
};
