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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("event_id");
            $table->foreign("event_id")
            ->references("id")
            ->on("events")
            ->onDelete("cascade");

            $table->unsignedBigInteger("zone_id");
            $table->foreign("zone_id")
            ->references("id")
            ->on("zones")
            ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
