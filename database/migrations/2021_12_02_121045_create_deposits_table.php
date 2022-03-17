<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('price')->nullable();
            $table->string('user_type')->default('student');
            $table->bigInteger('deposits_type_id')->default(0);
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('payment_id')->default(0);
            $table->text('title')->default('1400');
            $table->string('month')->default('1');
            $table->string('year')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
