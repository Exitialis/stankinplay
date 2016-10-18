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