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
        Schema::create('schedule_ipcr', function (Blueprint $table) {
            $table->id();
            $table->string("type", 4);
            $table->string("purpose", 50);
            $table->string("covered_period", 12);
            $table->string("office", 4);
            $table->string("employees", 255);
            $table->string("division_chief", 100);
            $table->string("director", 100);
            $table->date("duration_from");
            $table->date("duration_to");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_ipcr');
    }
};
