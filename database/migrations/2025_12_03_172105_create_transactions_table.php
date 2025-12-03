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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('sparepart_id')->constrained()->cascadeOnDelete();
        $table->foreignId('unit_id')->nullable()->constrained(); // Null jika barang masuk
        $table->enum('type', ['in', 'out']); // in = beli, out = pakai
        $table->integer('quantity');
        $table->date('transaction_date');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
