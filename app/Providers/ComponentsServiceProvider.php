<?php

namespace App\Providers;

use cebe\markdown\Markdown;
use Illuminate\Support\Facades\Blade;
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
        \Form::component('compInput', 'components.input', ['type' => 'text', 'model', 'label', 'required' => false, 'options' => []]);
        \Form::component('compSelect', 'components.select', ['model', 'prop', 'label', 'required' => false, 'options' => []]);
        \Form::component('compCheckbox', 'components.checkbox', ['model', 'label', 'options' => []]);

        Blade::directive('markdown', function ($content) {
            $markdown = new Markdown();
            $content = $markdown->parse($content);
            return "<?php echo ' ‘ . {$content}; ?>";
        });
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
