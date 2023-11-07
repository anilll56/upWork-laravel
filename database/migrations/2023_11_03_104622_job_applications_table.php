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
        Schema::create('job-applications', function (Blueprint $table) {
            $table->id();
            $table->integer('jobId');
            $table->string('name');
            $table->string('email');
            $table->string('requesterInfo');
            $table->enum('status', ["pending", "accepted", "rejected"])->default('pending');
            $table->string("freelancerEmail")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
