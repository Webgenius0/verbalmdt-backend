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
        Schema::create('global_electrician_days', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();

            $table->string('story_name')->nullable();
            $table->string('story_image')->nullable();
            $table->text('story_description')->nullable();

            $table->string('mission_name')->nullable();
            $table->string('mission_image')->nullable();
            $table->text('mission_description')->nullable();

            $table->string('matters_name')->nullable();
            $table->string('matters_image')->nullable();
            $table->text('matters_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_electrician_days');
    }
};
