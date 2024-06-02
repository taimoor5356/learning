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
            $table->id()->autoIncrement();
            // visitor
            $table->string('class_type')->nullable();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->unique();
            $table->json('qualification')->nullable();
            $table->string('class_year')->nullable();
            $table->string('subject_type')->nullable();
            $table->string('class_program')->nullable();
            $table->string('domicile')->nullable();
            $table->json('subjects')->nullable();

            // student
            $table->date('batch_starting_date')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('applied_for')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('interview_type')->nullable();
            $table->integer('exam_id')->nullable();
            $table->string('installments')->nullable();
            $table->string('discounted_amount')->nullable();
            $table->string('discount_reason')->nullable();
            $table->string('paid_fee')->nullable();
            $table->string('total_fee')->nullable();
            $table->string('remaining_dues')->nullable();
            $table->date('due_date')->nullable();
            $table->date('freeze_date')->nullable();
            $table->date('left_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('challan_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('payment_refund')->nullable();

            // student profile
            $table->string('profile_pic')->nullable();
            $table->string('fee_slip')->nullable();
            $table->string('father_name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('cnic')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('work_experience')->nullable(); // profession
            $table->longText('address')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->json('optional_subjects')->nullable();
            $table->string('rules_regulations')->nullable();
            $table->string('declaration')->nullable();
            $table->string('rules_regulations_policies')->nullable();
            $table->json('user_review')->nullable();

            // student profile 2
            $table->string('written_exam_serial_number')->nullable();
            $table->string('exam_roll_number')->nullable();
            $table->string('full_interview_mock_preparation')->nullable(); // applying for
            $table->string('mock_interview')->nullable();
            $table->string('mock_interview_date')->nullable();
            $table->string('mock_interview_time')->nullable();
            $table->string('written_exam_preparation_from_csps')->nullable();
            $table->string('join_whatsapp_group')->nullable();



            $table->tinyInteger('status')->comment('0:in_active, 1:active, 3:pending')->default(1);
            $table->string('note')->nullable();
            $table->string('admission_date')->nullable();
            $table->integer('role_id')->nullable();
            $table->tinyInteger('user_type')->comment('1:admin, 2:teacher, 3:student, 4:parent')->default(3);
            $table->tinyInteger('send_fee_notification')->default(0);





            $table->string('password');
            $table->string('admission_number')->nullable();
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('otp')->nullable();
            $table->integer('otp_verified')->default(0);
            $table->longText('otp_token')->nullable();

            $table->string('remember_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
