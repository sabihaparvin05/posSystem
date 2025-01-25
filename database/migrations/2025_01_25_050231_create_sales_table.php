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
        Schema::create('sales', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('invoice_number')->unique(); // Unique invoice number
            $table->string('customer_name'); // Customer name
            $table->decimal('total', 10, 2); // Total amount of the sale
            $table->decimal('vat', 10, 2)->default(0); // VAT applied
            $table->decimal('tax', 10, 2)->default(0); // Tax applied
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
