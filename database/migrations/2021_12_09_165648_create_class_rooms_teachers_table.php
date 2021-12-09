<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomsTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms_teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('field_id')->nullable();
            $table->bigInteger('field_parent_id')->nullable();
            $table->bigInteger('class_rooms_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->string('t_mark')->default(0);
            $table->string('a_mark')->default(0);
            $table->string('mark')->default(0);
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
        Schema::dropIfExists('class_rooms_teachers');
    }
}
