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
        Schema::create('submitted_fees', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id');
            $table->integer('class_id');
            $table->double('total_amount', 8,2)->default(0);
            $table->double('paid_amount', 8,2)->default(0);
            $table->double('remaining_amount', 8,2)->default(0);
            $table->string('payment_type')->nullable();
            $table->longText('description')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_fees');
    }
};
