<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_invites', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('invited_id')->unsigned();
            $table->foreign('invited_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('inviter_id')->unsigned();
            $table->foreign('inviter_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('invite_user_statuses')->onDelete('cascade');

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
        Schema::dropIfExists('user_invites');
    }
}
