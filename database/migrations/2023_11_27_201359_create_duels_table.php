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
        Schema::create('duels', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('celebrated_at');
            $table->unsignedBigInteger('winner_id')->nullable()->default(null);
            $table->unsignedBigInteger('loser_id')->nullable()->default(null);
            $table->integer('winner_mana_raised');
            $table->integer('loser_mana_raised');
            $table->timestamps();

            $table->foreign('winner_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('loser_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duels');
    }
};
