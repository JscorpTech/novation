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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('bundle_id')->constrained('bundles')->onDelete("set null");
            $table->foreignId("plan_id")->nullable()->constrained("plans");
            $table->foreignId("promocode_id")->nullable()->constrained("promocodes");
            $table->integer("discount")->default(0);
            $table->integer("original_price")->default(0);
            $table->integer("price")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
