<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_revenues', function (Blueprint $table) {
            $table->id();
            $table->date('revenue_date');
            $table->string('merchant_name', 150);
            $table->decimal('amount', 15, 2);
            $table->timestamps();

            $table->index(['revenue_date', 'merchant_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_revenues');
    }
};
