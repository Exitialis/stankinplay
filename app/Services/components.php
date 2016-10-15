<?php

if ( ! function_exists('attrs')) {

    function attrs(array $options = [], array $additional = []) {
        $attrs = [];
        $options = $options + $additional;
        foreach($options as $key => $value) {
            $attrs[] = is_numeric($key) ? $value : $key . '="' . e($value) . '"';
        }
        
        return count($attrs) ? implode(' ', $attrs) : '';
    }
}

if ( ! function_exists('title')) {

    function title($name, array $options = []) {
        return \Form::compTitle($name, $options);
    }
}

if ( ! function_exists('form')) {

    function form($model = null, array $options = []) {
        $form = app()->make('form');

        if ( ! $model && ! count($options)) {
            return $form->close();
        }

        if (is_array($model)) {
            return $form->open($model);
        }

        return $form->model($model, $options);
    }
}

// if ( ! function_exists('html')) {

//     function html() {   
//         return app()->make('html');
//     }
// }

if ( ! function_exists('label')) {

    function label($name, $required = false) {
        return \Form::compLabel($name, $required);
    }
}

if ( ! function_exists('input')) {

    function input($type, $model, array $options = []) {
        return \Form::compInput($type, $model, $options);
    }
}

if ( ! function_exists('text')) {

    function text($model, array $options = []) {
        return input('text', $model, $options);
    }
}

// if ( ! function_exists('textarea')) {

//     function textarea($name, $value = null, array $options = []) {
//         return \Form::compTextarea($name, $value, $options);
//     }
// }

// if ( ! function_exists('hidden')) {

//     function hidden($name, $value = null, array $options = []) {
//         return \Form::compHidden($name, $value, $options);
//     }
// }

if ( ! function_exists('select')) {

    function select($model, $prop, array $options = []) {
        return \Form::compSelect($model, $prop, $options);
    }
}

if ( ! function_exists('checkbox')) {

    function checkbox($model, $label) {
        return \Form::compCheckbox($model, $label);
    }
}

// if ( ! function_exists('submit')) {

//     function submit($name, array $options = []) {
//         return \Form::compSubmit($name, $options);
//     }
// }

// if ( ! function_exists('table')) {

//     function table($items, array $fields = [], string $notFound = null) {
//         return \Form::compTable($items, $fields, $notFound);
//     }
// }

// if ( ! function_exists('desc')) {

//     function desc($name, $value) {
//         return \Form::compDesc($name, $value);
//     }
// }