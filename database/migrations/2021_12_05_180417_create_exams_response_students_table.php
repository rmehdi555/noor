<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsResponseStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_response_students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->bigInteger('exams_id')->nullable();
            $table->bigInteger('exams_questions_id')->nullable();
            $table->string('exams_questions_type')->nullable();
            $table->text('response')->nullable();
            $table->string('t_mark')->default(0);
            $table->string('a_mark')->default(0);
            $table->string('mark')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams_response_students');
    }
}
