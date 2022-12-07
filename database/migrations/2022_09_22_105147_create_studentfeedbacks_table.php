<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentfeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentfeedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('student_no');
            $table->string('st_feedback');
            $table->string('st_feedbackdate');
            $table->string('ment_feedback');
            $table->string('ment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentfeedbacks');
    }
}
