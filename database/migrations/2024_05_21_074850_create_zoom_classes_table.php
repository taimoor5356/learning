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
        Schema::create('zoom_classes', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->longText('zoom_link')->nullable();
            $table->integer('status')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoom_classes');
    }
};
