<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Status: pending, completed, reviewed, accepted, rejected, waitlisted,
     *         acceptance_sent, attended, absent
     */
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_viewed_program_details')->default(false);
            $table->string('full_name');
            $table->string('national_id')->unique();
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->string('nationality')->nullable();
            $table->string('education_stage');
            $table->string('gender')->nullable();
            $table->string('region');
            $table->string('commitment_status');
            $table->string('referral_source');
            $table->string('referral_source_other')->nullable();
            $table->string('status', 32)->default('completed');
            $table->integer('score')->default(0);
            $table->text('notes')->nullable();
            $table->timestamp('acceptance_sent_at')->nullable();
            $table->timestamp('checked_in_at')->nullable();
            $table->string('checkin_token', 36)->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
