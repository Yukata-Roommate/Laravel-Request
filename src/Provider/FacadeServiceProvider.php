<?php

namespace YukataRm\Laravel\Request\Provider;

use YukataRm\Laravel\Provider\FacadeServiceProvider as BaseServiceProvider;

use YukataRm\Laravel\Request\Facade\Manager;
use YukataRm\Laravel\Request\Facade\Input;

/**
 * Facade Service Provider
 * 
 * @package YukataRm\Laravel\Request\Provider
 */
class FacadeServiceProvider extends BaseServiceProvider
{
    /**
     * get facades
     * 
     * @return array<string, string>
     */
    protected function facades(): array
    {
        return [
            Input::class => Manager::class
        ];
    }
}
