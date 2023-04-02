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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->nullable();
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('finalltotal')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('support')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
