<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

abstract class TestCase extends BaseTestCase
{
   use CreatesApplication;

    protected function convertToValidationErrors(array $errors)
    {
        $bag = new ViewErrorBag();
        $bag->put('default', new MessageBag($errors));

        return $bag;
    }
}
