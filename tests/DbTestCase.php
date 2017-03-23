<?php

namespace Tests;

use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


abstract class DbTestCase extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @var Generator
     */
    protected $faker;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->seed();

        $this->user = User::first();
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