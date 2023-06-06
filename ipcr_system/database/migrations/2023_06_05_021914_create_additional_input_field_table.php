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
        Schema::create('additional_input_field', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 10);
            $table->string('code');
            $table->string('functions')->nullable();
            $table->string('success_indicators')->nullable();
            $table->string('actual_accomplishments')->nullable();
            $table->string('semester', 50);
            $table->string('year', 50);
            $table->string('q1')->nullable();
            $table->string('e2')->nullable();
            $table->string('t3')->nullable();
            $table->string('a4')->nullable();
            $table->string('remarks')->nullable();
            $table->string('graded_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_input_field');
    }
};
