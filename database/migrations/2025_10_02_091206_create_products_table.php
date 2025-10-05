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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->longText('description')->nullable();
            
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('quantity');
            $table->decimal('price',10,2);
            $table->boolean('is_visible')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->enum('type',['delievarable','downloadable'])->default('delievarable');
            $table->date('published_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
