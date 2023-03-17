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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->text('comment');
            $table->string('rating');
            $table->string('status')->default(0); // gerer par l'admin (lorsqu'il approuve la valeur change)
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // pour que le vendeur recoivent des notifs à chaque commentaire
            $table->string('user_purchased')->nullable();
            $table->string('date_purchased')->nullable();
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
        Schema::dropIfExists('reviews');
    }
};
