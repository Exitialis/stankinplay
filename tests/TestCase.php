<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
   use CreatesApplication;

//    public function assertValidation(array $errors)
//    {
//        $bag = new ViewErrorBag();
//        $bag->put('default', new MessageBag($errors);
//
//        $this->assertSessionHas()
//    }
}
