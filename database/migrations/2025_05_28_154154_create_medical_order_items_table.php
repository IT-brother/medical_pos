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
        Schema::create('medical_order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("medical_order_id")->unsigned();
            $table->bigInteger("medical_id")->unsigned();
            $table->integer("quantity");
            $table->double("price",12,2);
            $table->timestamps();
            $table->foreign("medical_order_id")->references("id")->on("medical_orders");
            $table->foreign("medical_id")->references("id")->on("medicals");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_order_items');
    }
};
