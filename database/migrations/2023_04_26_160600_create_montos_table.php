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
        Schema::create('montos', function (Blueprint $table) {
            $table->id();
            $table->integer('concepto_id');
            $table->decimal('personal');
            $table->decimal('patronal');
            $table->decimal('total');
            $table->integer('mes');
            $table->integer('año');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('montos');
    }
};
