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
    Schema::create('spareparts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        $table->string('part_number')->unique();
        $table->string('name');
        
        $table->integer('stock')->default(0);
        $table->integer('min_stock')->default(5);
        
        // --- TAMBAHKAN BARIS INI ---
        $table->string('unit')->default('Pcs'); // Satuan (Pcs, Set, Liter)
        // ---------------------------

        $table->string('location')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
