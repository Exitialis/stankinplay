<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComponentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::component('compTitle', 'components.title', ['name', 'options' => []]);
        \Form::component('compLabel', 'components.label', ['name', 'required']);
        \Form::component('compInput', 'components.input', ['type' => 'text', 'model', 'options' => []]);
        \Form::component('compSelect', 'components.select', ['model', 'prop', 'options' => []]);
        \Form::component('compCheckbox', 'components.checkbox', ['model', 'label']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
