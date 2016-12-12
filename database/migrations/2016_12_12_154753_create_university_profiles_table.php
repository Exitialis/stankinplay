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
            $table->index('id');

            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('group');
            $table->integer('studentID');
            $table->boolean('module')->default(0);
            $table->boolean('budget')->default(0);
            $table->boolean('grants')->default(0);

            $table->timestamps();
            $table->primary('id');
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
