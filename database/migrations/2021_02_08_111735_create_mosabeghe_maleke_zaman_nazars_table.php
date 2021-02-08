<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMosabegheMalekeZamanNazarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mosabeghe_maleke_zaman_nazars', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('value')->nullable();
            $table->string('user_meli_number')->nullable();
            $table->string('user_mosabeghe_id')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('mosabeghe_maleke_zaman_nazars');
    }
}
