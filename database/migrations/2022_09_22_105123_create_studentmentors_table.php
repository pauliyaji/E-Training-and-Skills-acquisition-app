<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentmentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentmentors', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('mentor_id');
            $table->string('duration');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('auth_id');
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
        Schema::dropIfExists('studentmentors');
    }
}
