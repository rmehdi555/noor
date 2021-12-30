<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActListHefzTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_list_hefz_t_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('user_id_teacher')->nullable();
            $table->bigInteger('user_id_student')->nullable();
            $table->bigInteger('class_rooms_id')->nullable();
            $table->bigInteger('class_rooms_students_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->text('description')->nullable();
            $table->text('takalif')->nullable();
            $table->string('mark_hefz')->nullable();
            $table->string('mark_do_dars')->nullable();
            $table->string('mark_hasht_dars')->nullable();
            $table->string('mark_d1')->nullable();
            $table->integer('j_d1')->nullable();
            $table->string('mark_d2')->nullable();
            $table->integer('j_d2')->nullable();
            $table->string('mark_d3')->nullable();
            $table->integer('j_d3')->nullable();
            $table->string('mark_d4')->nullable();
            $table->integer('j_d4')->nullable();
            $table->string('mark_d5')->nullable();
            $table->integer('j_d5')->nullable();
            $table->string('mark_d6')->nullable();
            $table->integer('j_d6')->nullable();
            $table->string('mark_hefz_t')->nullable();
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
        Schema::dropIfExists('act_list_hefz_t_s');
    }
}
