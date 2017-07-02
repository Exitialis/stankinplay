<?php

namespace Tests\Feature;

use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\Artisan;
use Tests\DbTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeployScriptTest extends TestCase
{
    public function test()
    {
        $this->assertTrue(true);
    }

    /*
    public function setUp()
    {
        parent::setUp();

        \DB::unprepared(file_get_contents(base_path('tests/dumps/dump.sql')));
    }

    public function testTablesHasBeenCleared()
    {
        \Artisan::call('deploy');

        $this->assertFalse(\DB::table('migrations')->where('migration', 'LIKE', '%csgo%')->first());
        $this->assertFalse(\DB::table('migrations')->where('migration', 'LIKE', '%csgo%')->first());

        $this->assertFalse(\Schema::exists('csgo_profiles'));
        $this->assertFalse(\Schema::exists('steam_profiles'));
    }*/
    /*
    public function testTeamRelationHasBeenMovedInAnotherTable()
    {
        \Artisan::call('deploy');
    }
    */
}
