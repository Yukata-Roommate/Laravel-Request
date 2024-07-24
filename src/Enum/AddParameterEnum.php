<?php

namespace YukataRm\Laravel\Request\Enum;

/**
 * Add Parameter Enum
 * 
 * @package YukataRm\Laravel\Request\Enum
 */
enum AddParameterEnum: string
{
    case URL        = "url";
    case METHOD     = "method";
    case IP         = "ip";
    case USER_AGENT = "user_agent";
    case DATETIME   = "datetime";
}
