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
        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("product_id")->unsigned();
            $table->string("locale")->index(); // ar en 
            $table->string("title")->nullable();
            $table->text("content")->nullable();
            $table->text("smallDesc")->nullable();
            $table->string("price")->nullable();
            $table->unique(["product_id", "locale"]);
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};
