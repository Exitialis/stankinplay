<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCsgoProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csgo_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kills')->unsigned();
            $table->integer('deaths')->unsigned();
            $table->integer('time_played')->unsigned();
            $table->integer('wins')->unsigned();
            $table->integer('kills_headshot')->unsigned();
            $table->integer('shots_fired')->unsigned();
            $table->integer('shots_hit')->unsigned();
            $table->integer('mvps')->unsigned();
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
        Schema::dropIfExists('csgo_profiles');
    }
}