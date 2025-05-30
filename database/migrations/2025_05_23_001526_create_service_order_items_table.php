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
        Schema::create('service_order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("service_order_id")->unsigned();
            $table->bigInteger("service_id")->unsigned();
            $table->integer("quantity");
            $table->double("price",12,2);
            $table->timestamps();
            $table->foreign("service_order_id")->references("id")->on("service_orders");
            $table->foreign("service_id")->references("id")->on("services");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_order_items');
    }
};
