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
        Schema::create('draft_ipcr', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 10);
            $table->string('code');
            $table->string('functions')->nullable();
            $table->string('success_indicators')->nullable();
            $table->string('semester', 50);
            $table->string('year', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_ipcr');
    }
};
