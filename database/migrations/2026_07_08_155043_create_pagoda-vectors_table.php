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
    Schema::create('pagoda_vectors', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pagoda_id')->constrained('pagodas')->onDelete('cascade');
        $table->text('embedding')->nullable(); // AI Vector တွေ သိမ်းရန်
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagoda_vectors');
    }
};
