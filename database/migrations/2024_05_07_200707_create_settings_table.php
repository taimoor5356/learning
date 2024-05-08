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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_logo')->nullable();
            $table->string('school_logo_name')->nullable();
            $table->string('school_browser_icon')->nullable();
            $table->string('school_name')->nullable();
            $table->longText('school_description')->nullable();
            $table->string('school_email')->nullable();
            $table->string('school_email_password')->nullable();
            $table->string('school_email_api_key')->nullable();
            $table->longText('school_email_description')->nullable();
            $table->string('school_sms_api_key')->nullable();
            $table->longText('school_exam_report_description')->nullable();
            $table->string('school_login_page_image_one')->nullable();
            $table->string('school_login_page_image_two')->nullable();
            $table->string('school_login_page_image_three')->nullable();
            $table->string('school_login_page_image_four')->nullable();
            $table->string('school_login_page_image_five')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
