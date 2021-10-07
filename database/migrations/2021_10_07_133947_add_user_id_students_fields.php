<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdStudentsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_fields', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('student_id')->default(0);
            $table->bigInteger('payment_id')->after('user_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students_fields', function (Blueprint $table) {
            //
        });
    }
}
