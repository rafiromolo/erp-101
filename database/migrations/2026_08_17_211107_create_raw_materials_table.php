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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_category_id')->constrained('material_categories');
            $table->foreignId('unit_id')->constrained('units');
            $table->string('sku')->unique();
            $table->string('name');
            $table->decimal('min_stock', 10, 2)->default(0);
            $table->boolean('is_perishable')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
