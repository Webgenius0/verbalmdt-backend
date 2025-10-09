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
        Schema::table('global_electrician_registrations', function (Blueprint $table) {
            $table->string('licence_number', 100)->nullable();
            $table->string('licence_agency_url', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_electrician_registrations', function (Blueprint $table) {
            //
        });
    }
};
