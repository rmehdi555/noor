<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersWorkHoursListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_work_hours_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->text('name')->default(0);
            $table->text('description')->nullable();
            $table->string('price_hours')->nullable();
            $table->string('hours')->default(0);
            $table->text('a_description')->nullable();
            $table->string('a_price')->default(0);
            $table->text('k_description')->nullable();
            $table->string('k_price')->default(0);
            $table->string('totalSum')->default(0);
            $table->text('card_name')->nullable();
            $table->text('card_number')->nullable();
            $table->text('sheba_number')->nullable();
            $table->text('bank_name')->nullable();
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
        Schema::dropIfExists('teachers_work_hours_lists');
    }
}
