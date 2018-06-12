<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlockusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('flock-config.connectionToUse'))->create('flock-users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('user_id', 64);
            $table->string('user_token');
            $table->string('user_name')->nullable();

            $table->tinyInteger('is_installed');

            $table->index('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('flock-config.connectionToUse'))->dropIfExists('flock-users');
    }
}
