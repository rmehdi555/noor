<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMosabegheJavabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mosabeghe_javabs', function (Blueprint $table) {
            $table->id();
            $table->integer('soal_id')->nullable();
            $table->integer('javab_id')->nullable();
            $table->integer('javab_user_id')->nullable();
            $table->string('user_meli_number')->nullable();
            $table->string('user_mosabeghe_id')->nullable();
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
        Schema::dropIfExists('mosabeghe_javabs');
    }
}
