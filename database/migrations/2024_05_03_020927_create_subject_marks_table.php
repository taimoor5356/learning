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
        Schema::create('subject_marks', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('student_id');
            $table->integer('exam_id');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->string('class_work')->nullable();
            $table->string('home_work')->nullable();
            $table->string('test_work')->nullable();
            $table->string('exam_work')->nullable();
            $table->integer('full_marks')->default(0);
            $table->integer('passing_marks')->default(0);
            $table->integer('created_by');
            $table->string('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_marks');
    }
};
