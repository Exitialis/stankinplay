<?php

if ( ! function_exists('flash')) {

    /**
     * Сборка всплывающего сообщения.
     *
     * @param $message
     * @param string $level
     * @return array
     */
    function flash($message, $level = 'success')
    {
        return ['flash' =>
            [
                'message' => $message,
                'level' => $level
            ]
        ];
    }

}

if ( ! function_exists('notificate')) {

    function notificate($message, $level = 'success')
    {
        Session::flash('notificate', flash($message, $level));
    }

}

if ( ! function_exists('active_link')) {
    function active_link($route, $className = 'active') {
        $routes = count(func_get_args()) ? func_get_args() : [$route];
        $current = app('router')->currentRouteName();

        foreach ($routes as $route) {
            if (starts_with($current, $route)) {
                return $className;
            }
        }

        return null;
    }
}
