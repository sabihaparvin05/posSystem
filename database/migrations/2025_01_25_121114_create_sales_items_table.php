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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade'); // Foreign key to sales table
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products table
            $table->integer('quantity'); // Quantity of the product sold
            $table->decimal('price', 10, 2); // Price per unit
            $table->decimal('subtotal', 10, 2); // Subtotal (quantity * price)
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
