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
        Schema::create('job_detail', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('loaction');
            $table->longText('description');
            $table->longText('responsibility');
            $table->longText('qualifications');
            $table->longText('benefits');
            $table->string('vacancy');
            $table->string('salary');
            $table->string('location');
            $table->string('name_company');
            $table->string('website');
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_detail');
    }
};
