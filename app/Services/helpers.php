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

    function notificate($message, $level)
    {
        Session::flash('notificate', flash($message, $level));
    }

}