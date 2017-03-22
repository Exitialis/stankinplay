<?php

namespace Tests;

use App\Models\User;
use Faker\Factory;
use Faker\Generator;


abstract class DbTestCase extends TestCase
{
    /**
     * @var Generator
     */
    protected $faker;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->loadMigrations();
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