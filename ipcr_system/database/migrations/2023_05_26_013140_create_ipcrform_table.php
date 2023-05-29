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
            $table->date('date_created');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->char('mi', 1);
            $table->string('position', 30);
            $table->string('office', 50);
            $table->string('email')->unique();
            $table->string('reviewer', 100);
            $table->string('approver', 100);
            $table->string('status', 50);
            $table->string('strategic_priorities1', 200)->nullable();
            $table->string('success_indicator1', 200)->nullable();
            $table->string('actual_accomplishments1', 200)->nullable();
            $table->string('q1_1', 1)->nullable();
            $table->string('e2_1', 1)->nullable();
            $table->string('t3_1', 1)->nullable();
            $table->string('a4_1', 1)->nullable();
            $table->string('remarks1', 200)->nullable();
            $table->string('reviewer1', 100)->nullable();
            $table->string('strategic_priorities2', 200)->nullable();
            $table->string('success_indicator2', 200)->nullable();
            $table->string('actual_accomplishments2', 200)->nullable();
            $table->string('q1_2', 1)->nullable();
            $table->string('e2_2', 1)->nullable();
            $table->string('t3_2', 1)->nullable();
            $table->string('a4_2', 1)->nullable();
            $table->string('remarks2', 200)->nullable();
            $table->string('reviewer2', 100)->nullable();
            $table->string('strategic_priorities3', 200)->nullable();
            $table->string('success_indicator3', 200)->nullable();
            $table->string('actual_accomplishments3', 200)->nullable();
            $table->string('q1_3', 1)->nullable();
            $table->string('e2_3', 1)->nullable();
            $table->string('t3_3', 1)->nullable();
            $table->string('a4_3', 1)->nullable();
            $table->string('remarks3', 200)->nullable();
            $table->string('reviewer3', 100)->nullable();
            $table->string('strategic_priorities4', 200)->nullable();
            $table->string('success_indicator4', 200)->nullable();
            $table->string('actual_accomplishments4', 200)->nullable();
            $table->string('q1_4', 1)->nullable();
            $table->string('e2_4', 1)->nullable();
            $table->string('t3_4', 1)->nullable();
            $table->string('a4_4', 1)->nullable();
            $table->string('remarks4', 200)->nullable();
            $table->string('reviewer4', 100)->nullable();
            $table->string('core_functions5', 200)->nullable();
            $table->string('success_indicator5', 200)->nullable();
            $table->string('actual_accomplishments5', 200)->nullable();
            $table->string('q1_5', 1)->nullable();
            $table->string('e2_5', 1)->nullable();
            $table->string('t3_5', 1)->nullable();
            $table->string('a4_5', 1)->nullable();
            $table->string('remarks5', 200)->nullable();
            $table->string('reviewer5', 100)->nullable();
            $table->string('core_functions6', 200)->nullable();
            $table->string('success_indicator6', 200)->nullable();
            $table->string('actual_accomplishments6', 200)->nullable();
            $table->string('q1_6', 1)->nullable();
            $table->string('e2_6', 1)->nullable();
            $table->string('t3_6', 1)->nullable();
            $table->string('a4_6', 1)->nullable();
            $table->string('remarks6', 200)->nullable();
            $table->string('reviewer6', 100)->nullable();
            $table->string('core_functions7', 200)->nullable();
            $table->string('success_indicator7', 200)->nullable();
            $table->string('actual_accomplishments7', 200)->nullable();
            $table->string('q1_7', 1)->nullable();
            $table->string('e2_7', 1)->nullable();
            $table->string('t3_7', 1)->nullable();
            $table->string('a4_7', 1)->nullable();
            $table->string('remarks7', 200)->nullable();
            $table->string('reviewer7', 100)->nullable();
            $table->string('core_functions8', 200)->nullable();
            $table->string('success_indicator8', 200)->nullable();
            $table->string('actual_accomplishments8', 200)->nullable();
            $table->string('q1_8', 1)->nullable();
            $table->string('e2_8', 1)->nullable();
            $table->string('t3_8', 1)->nullable();
            $table->string('a4_8', 1)->nullable();
            $table->string('remarks8', 200)->nullable();
            $table->string('reviewer8', 100)->nullable();
            $table->string('support_functions9', 200)->nullable();
            $table->string('success_indicator9', 200)->nullable();
            $table->string('actual_accomplishments9', 200)->nullable();
            $table->string('q1_9', 1)->nullable();
            $table->string('e2_9', 1)->nullable();
            $table->string('t3_9', 1)->nullable();
            $table->string('a4_9', 1)->nullable();
            $table->string('remarks9', 200)->nullable();
            $table->string('reviewer9', 100)->nullable();
            $table->string('support_functions10', 200)->nullable();
            $table->string('success_indicator10', 200)->nullable();
            $table->string('actual_accomplishments10', 200)->nullable();
            $table->string('q1_10', 1)->nullable();
            $table->string('e2_10', 1)->nullable();
            $table->string('t3_10', 1)->nullable();
            $table->string('a4_10', 1)->nullable();
            $table->string('remarks10', 200)->nullable();
            $table->string('reviewer10', 100)->nullable();
            $table->string('support_functions11', 200)->nullable();
            $table->string('success_indicator11', 200)->nullable();
            $table->string('actual_accomplishments11', 200)->nullable();
            $table->string('q1_11', 1)->nullable();
            $table->string('e2_11', 1)->nullable();
            $table->string('t3_11', 1)->nullable();
            $table->string('a4_11', 1)->nullable();
            $table->string('remarks11', 200)->nullable();
            $table->string('reviewer11', 100)->nullable();
            $table->string('support_functions12', 200)->nullable();
            $table->string('success_indicator12', 200)->nullable();
            $table->string('actual_accomplishments12', 200)->nullable();
            $table->string('q1_12', 1)->nullable();
            $table->string('e2_12', 1)->nullable();
            $table->string('t3_12', 1)->nullable();
            $table->string('a4_12', 1)->nullable();
            $table->string('remarks12', 200)->nullable();
            $table->string('reviewer12', 100)->nullable();
            $table->string('rating', 1)->nullable();
            $table->string('comment', 200)->nullable();
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
