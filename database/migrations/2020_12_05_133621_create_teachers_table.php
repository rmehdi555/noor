<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('flag_cookie')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('f_name')->nullable();
            $table->string('sh_number')->nullable();
            $table->string('meli_number')->nullable();
            $table->string('sh_sodor')->nullable();
            $table->string('tavalod_date')->nullable();
            $table->string('married')->default('no');
            $table->string('phone_1')->unique();
            $table->string('phone_2')->nullable();
            $table->string('phone_f')->nullable();
            $table->string('phone_m')->nullable();
            $table->string('tel')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('address')->nullable();
            $table->string('post_number')->nullable();
            $table->string('education')->nullable();
            $table->string('job')->nullable();
            $table->string('email')->nullable();
            $table->string('number_of_children')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
