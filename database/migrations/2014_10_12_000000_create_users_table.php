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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('address')->nullable();
            $table->tinyInteger('user_type')->comment('1:admin, 2:teacher, 3:student, 4:parent')->default(3);
            $table->tinyInteger('status')->comment('0:in_active, 1:active, 3:pending')->default(1);
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('admission_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('qualification')->nullable();
            $table->string('work_experience')->nullable();
            $table->string('note')->nullable();
            $table->string('otp')->nullable();
            $table->integer('otp_verified')->default(0);
            $table->longText('otp_token')->nullable();

            $table->string('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
