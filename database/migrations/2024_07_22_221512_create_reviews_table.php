<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 
        public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->unsignedBigInteger('checkout_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->integer('rating');
            $table->string('photo')->nullable();
            $table->foreign('checkout_id')->references('checkout_id')->on('checkouts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
