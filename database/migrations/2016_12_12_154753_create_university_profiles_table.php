<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversityProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_profiles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups');

            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->integer('studentID')->nullable();
            $table->boolean('module')->default(0);
            $table->boolean('budget')->default(0)->nullable();
            $table->boolean('grants')->default(0)->nullable();

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
        Schema::dropIfExists('university_profiles');
    }
}
