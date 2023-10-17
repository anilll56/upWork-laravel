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
        Schema::create('client-work-table', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('work-type');
        $table->string('work-description');
        $table->integer('work-price');
        $table->enum('work-status' , ["continues", "completed"])->default('continues');
        $table->json('employed-freelancers')->nullable();
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
