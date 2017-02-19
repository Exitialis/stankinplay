<?php

use App\Console\Kernel;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


abstract class DbTestCase extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    protected $faker;

    public function setUp()
    {
        parent::setUp();

        $this->loadMigrations();
        $this->faker = Factory::create();
        $this->seed();
    }

    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @throws Exception
     */
    protected function loadMigrations()
    {
        $this->artisan('migrate');
        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }
}