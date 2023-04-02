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
        Schema::create('order_translations', function (Blueprint $table) {
            $table->increments("id");
            $table->string("locale")->index(); // ar en 
            $table->integer("order_id")->unsigned();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->default('ordered');
            $table->unique(["order_id", "locale"]);
            $table->timestamps();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_translations');
    }
};
