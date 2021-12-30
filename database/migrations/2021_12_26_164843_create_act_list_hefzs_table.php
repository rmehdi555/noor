<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActListHefzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_list_hefzs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('user_id_teacher')->nullable();
            $table->bigInteger('user_id_student')->nullable();
            $table->bigInteger('class_rooms_id')->nullable();
            $table->bigInteger('class_rooms_students_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->text('description')->nullable();
            $table->string('mark_hefz')->nullable();
            $table->string('mark_dah_dars')->nullable();
            $table->string('mark_d1')->nullable();
            $table->integer('j_d1')->nullable();
            $table->string('mark_d2')->nullable();
            $table->integer('j_d2')->nullable();
            $table->string('mark')->nullable();
            $table->integer('presence')->default(0);
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
        Schema::dropIfExists('act_list_hefzs');
    }
}
