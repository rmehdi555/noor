<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomsStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms_students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('field_id')->nullable();
            $table->bigInteger('field_parent_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->bigInteger('students_field_id')->nullable();
            $table->bigInteger('class_rooms_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->integer('status')->default(0);
            $table->bigInteger('user_id_delete')->nullable();
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
        Schema::dropIfExists('class_rooms_students');
    }
}
