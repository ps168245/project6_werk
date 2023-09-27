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
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('image');
            $table->double('price');
            $table->double('suppliers_price');
            $table->integer('stock');
            $table->bigInteger('EAN');
            $table->text('SKU')->nullable();
            $table->integer('height_cm')->default(0);
            $table->integer('width_cm')->default(0);
            $table->integer('depth_cm')->default(0);
            $table->integer('weight_gr')->default(0);
            $table->tinyInteger('percentage_aanbieding')->nullable();
            $table->boolean('dag_aanbieding');
            $table->boolean('week_aanbieding');
            $table->unsignedBigInteger('last_edited_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('last_edited_by')->references('id')->on('users')->onDelete('set null');
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
