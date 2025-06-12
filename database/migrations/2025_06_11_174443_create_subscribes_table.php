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
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->char("status", 10)->default("active");
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("plan_id")->constrained("plans");
            $table->foreignId("card_id")->constrained("cards");
            $table->integer("quantity");
            $table->char("payment_status", 10)->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribes');
    }
};
