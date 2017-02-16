<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFiledsToUniversiryProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('university_profiles', function(Blueprint $table) {
            $table->boolean('anotherSections')->after('grants');
            $table->boolean('gto')->after('grants');
            $table->boolean('socialActivity')->after('grants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('university_profiles', function(Blueprint $table) {
            $table->dropColumn('anotherSections');
            $table->dropColumn('gto');
            $table->dropColumn('socialActivity');
        });
    }
}
