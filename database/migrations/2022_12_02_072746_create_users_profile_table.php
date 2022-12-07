<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unique()->references('id')->on('users')->onDelete('CASCADE');
            $table->string('surname', 255)->nullable();
            $table->string('patronymic', 255)->nullable();
            $table->string('phone')->nullable();
            $table->integer('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_profile');
    }
};
