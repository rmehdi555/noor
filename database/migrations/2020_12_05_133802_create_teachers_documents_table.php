<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('flag_cookie')->nullable();
            $table->string('url')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers_documents');
    }
}
