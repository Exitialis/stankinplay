<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

class UserController extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExport()
    {
        $controller = new \App\Http\Controllers\Api\User\UserController();

        $controller->export(new Request());
    }
}
