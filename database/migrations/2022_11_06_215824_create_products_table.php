<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_country')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_quantity');
            $table->json('product_size')->nullable();
            $table->json('product_color')->nullable();
            $table->string('product_price');
            $table->string('discount_price')->nullable();
            $table->text('long_description');
            $table->string('product_thumbnail');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
