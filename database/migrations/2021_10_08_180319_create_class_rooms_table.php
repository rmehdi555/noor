<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('field_id')->nullable();
            $table->bigInteger('field_parent_id')->nullable();
            $table->bigInteger('exam_id')->nullable();
            $table->string('name')->nullable();
            $table->string('mark_type')->nullable();
            $table->bigInteger('mark_type_id')->default(1);
            $table->text('description')->nullable();
            $table->string('number_students')->nullable();
            $table->string('old')->default(0);
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('class_rooms');
    }
}
