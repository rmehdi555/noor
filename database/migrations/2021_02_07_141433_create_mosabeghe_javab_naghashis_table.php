<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMosabegheJavabNaghashisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mosabeghe_javab_naghashis', function (Blueprint $table) {
            $table->id();
            $table->text('mosabeghe_name')->nullable();
            $table->text('file_url')->nullable();
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
        Schema::dropIfExists('mosabeghe_javab_naghashis');
    }
}
