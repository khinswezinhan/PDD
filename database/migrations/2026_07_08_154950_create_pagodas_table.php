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
        Schema::create('pagodas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->foreignId('township_id')->constrained()->onDelete('cascade');
            $table->string('history');
            $table->string('address');
            $table->string('website');
            $table->string('map-link');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagodas');
    }
};
