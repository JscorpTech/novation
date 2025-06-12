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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("bundle_id")->constrained("bundles");
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
        Schema::dropIfExists('carts');
    }
};
