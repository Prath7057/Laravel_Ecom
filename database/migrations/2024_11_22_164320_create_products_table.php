<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('prod_id')->primary();
            $table->string('prod_category');
            $table->string('prod_name');
            $table->text('prod_desc');
            $table->text('prod_collection');
            $table->decimal('prod_amount', 8, 2); 
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
