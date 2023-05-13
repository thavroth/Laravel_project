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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('event_name');
            $table->string('date');
            $table->string('time');
            $table->integer('amount_of_ticket');
            $table->unsignedBigInteger("sport_id");
            $table->foreign("sport_id")
            ->references("id")
            ->on("sports")
            ->onDelete("cascade");
            $table->unsignedBigInteger("location_id");
            $table->foreign("location_id")
            ->references("id")
            ->on("locations")
            ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
