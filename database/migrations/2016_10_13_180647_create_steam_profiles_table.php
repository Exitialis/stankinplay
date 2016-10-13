<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSteamProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steam_profiles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('steam_id')->nullable();
            $table->integer('steam64_id')->unsigned();

            $table->string('name');
            $table->string('profile_url');
            $table->string('avatar')->nullable();
            $table->string('realname')->nullable();

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
        Schema::dropIfExists('steam_profiles');
    }
}
