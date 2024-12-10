<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('prod_collection_slug'); 
            $table->string('prod_category_slug'); 
            $table->string('prod_name_slug'); 
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('prod_collection_slug');
            $table->dropColumn('prod_category_slug');
            $table->dropColumn('prod_name_slug'); 
        });
    }
};
