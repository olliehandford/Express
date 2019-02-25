<?php

function createError($msg) {
    $data = array(
        'errors' => [
            "error" => [
                $msg
            ]
        ],
        'message' => "The given data was invalid"
    );

    return $data;
}