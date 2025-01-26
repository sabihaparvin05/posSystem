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
        Schema::create('return_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade'); // Sale reference
            $table->foreignId('sales_item_id')->constrained('sales_items')->onDelete('cascade'); // Specific product reference
            $table->integer('quantity'); // Quantity being returned
            $table->decimal('amount_refunded', 10, 2); // Amount refunded
            $table->string('reason')->nullable(); // Reason for return
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_products');
    }
};
