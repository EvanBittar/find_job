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
Schema::create('jobs', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('category');
    $table->string('job_nature');
    $table->integer('vacancy');
    $table->string('salary')->nullable();
    $table->string('location'); // تأكد أنها l صغيرة ومفردة
    $table->text('description');
    $table->text('benefits')->nullable();
    $table->text('responsibility')->nullable();
    $table->text('qualifications')->nullable();
    $table->string('keywords')->nullable();
    $table->string('company_name');
    $table->string('company_location')->nullable(); // اسم فريد ومختلف
    $table->string('website')->nullable();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
