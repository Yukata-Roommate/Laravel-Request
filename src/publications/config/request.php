<?php

return [
    /*----------------------------------------*
     * Failed Authorization
     *----------------------------------------*/

    "unauthorized_message"     => env("CUSTOM_REQUEST_UNAUTHORIZED_MESSAGE", ""),
    "unauthorized_message_key" => env("CUSTOM_REQUEST_UNAUTHORIZED_MESSAGE_KEY", ""),

    /*----------------------------------------*
     * Logging
     *----------------------------------------*/

    "logging_parameters"   => env("CUSTOM_REQUEST_LOGGING_PARAMETERS", false),
    "logging_directly"     => env("CUSTOM_REQUEST_LOGGING_DIRECTLY", "request"),
    "log_format"           => env("CUSTOM_REQUEST_LOG_FORMAT", "%message%"),
    "log_parameter_format" => env("CUSTOM_REQUEST_LOG_PARAMETER_FORMAT", ""),
    "masking_text"         => env("CUSTOM_REQUEST_MASKING_TEXT", "********"),
    "masking_parameters"   => [],
    "add_parameters"       => [],
];
