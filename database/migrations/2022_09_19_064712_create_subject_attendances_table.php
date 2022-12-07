<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('class_id');
            $table->string('course_id');
            $table->string('subject_id');
            $table->string('student_id');
            $table->string('present');
            $table->string('absent');
            $table->string('date');
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
        Schema::dropIfExists('subject_attendances');
    }
}
