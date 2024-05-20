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
        Schema::create('home_works', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->string('homework_date')->nullable();
            $table->string('submission_date')->nullable();
            $table->string('document')->nullable();
            $table->longText('description')->nullable();
            $table->integer('created_by');
            $table->string('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_works');
    }
};
