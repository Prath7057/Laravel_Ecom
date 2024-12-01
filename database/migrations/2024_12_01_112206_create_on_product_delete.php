<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('on_product_delete', function (Blueprint $table) {
            $table->foreignId('image_prod_id')
            ->constrained('products', 'prod_id')  
            ->onDelete('cascade');  
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('on_product_delete');
    }
};
