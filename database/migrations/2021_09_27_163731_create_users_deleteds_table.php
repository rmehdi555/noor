<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDeletedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_deleteds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->boolean('active')->default(false);
            $table->string('level')->default('user');
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('user_name')->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->integer('priority')->default(0);
            $table->integer('status')->default(0);
            $table->integer('old_id')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users_deleteds');
    }
}
