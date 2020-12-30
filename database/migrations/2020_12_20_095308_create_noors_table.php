<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noors', function (Blueprint $table) {
            $table->id();
            $table->string('price')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('f_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('meli_number')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('user_type')->nullable();
            $table->string('user_code')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->text('description')->nullable();
            $table->integer('monthly_payment')->default('1');
            $table->string('sex')->nullable();
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
        Schema::dropIfExists('noors');
    }
}
