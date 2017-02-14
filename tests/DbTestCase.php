<?php

use App\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


abstract class DbTestCase extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom();

    }

    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @param $realpath
     * @throws Exception
     */
    protected function loadMigrationsFrom()
    {
        $this->artisan('migrate');
        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }
}