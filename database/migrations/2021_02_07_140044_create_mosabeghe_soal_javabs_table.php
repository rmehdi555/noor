<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMosabegheSoalJavabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mosabeghe_soal_javabs', function (Blueprint $table) {
            $table->id();
            $table->integer('soal_id');
            $table->text('title')->nullable();
            $table->boolean('type')->default(false);
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
        Schema::dropIfExists('mosabeghe_soal_javabs');
    }
}
