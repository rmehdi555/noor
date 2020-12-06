<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_fields', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('flag_cookie')->nullable();
            $table->bigInteger('field_id')->nullable();
            $table->bigInteger('field_parent_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('students_fields');
    }
}
