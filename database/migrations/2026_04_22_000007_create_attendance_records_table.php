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
        if (! Schema::hasTable('attendance_records')) {
            Schema::create('attendance_records', function (Blueprint $table) {
                $table->id();
                $table->foreignId('attendance_event_id')->constrained()->cascadeOnDelete();
                $table->foreignId('employee_profile_id')->constrained('employees')->cascadeOnDelete();
                $table->timestamp('checked_in_at')->index();
                $table->timestamps();

                $table->unique(['attendance_event_id', 'employee_profile_id'], 'attendance_records_event_employee_unique');
            });

            return;
        }

        Schema::table('attendance_records', function (Blueprint $table) {
            $table->unique(['attendance_event_id', 'employee_profile_id'], 'attendance_records_event_employee_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};