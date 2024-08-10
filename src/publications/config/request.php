<?php

return [
    /*----------------------------------------*
     * Failed Authorization
     *----------------------------------------*/

    "unauthorized_message"     => env("YR_REQUEST_UNAUTHORIZED_MESSAGE", ""),
    "unauthorized_message_key" => env("YR_REQUEST_UNAUTHORIZED_MESSAGE_KEY", ""),

    /*----------------------------------------*
     * Logging
     *----------------------------------------*/

    "logging_parameters"   => env("YR_REQUEST_LOGGING_PARAMETERS", false),
    "logging_directly"     => env("YR_REQUEST_LOGGING_DIRECTLY", "request"),
    "add_parameters"       => [],

    /*----------------------------------------*
     * Masking
     *----------------------------------------*/

    "masking_text"       => env("YR_REQUEST_MASKING_TEXT", "********"),
    "masking_parameters" => [
        "password",
        "password_confirmation",
        "current_password",
        "new_password",
        "new_password_confirmation",
    ],
];
