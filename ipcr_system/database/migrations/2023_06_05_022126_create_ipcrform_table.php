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
        Schema::create('ipcrform', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 5);
            $table->date('date_created', 5);
            $table->date('covered_period', 20)->nullable();
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->char('mi', 1);
            $table->string('position', 30);
            $table->string('office', 50);
            $table->string('email')->unique();
            $table->string('reviewer', 100);
            $table->string('approver', 100);
            $table->string('status', 50);
            $table->string('far', 5)->nullable();
            $table->string('comment', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipcrform');
    }
};
