<?php

namespace YukataRm\Laravel\Request\Provider;

use Illuminate\Support\ServiceProvider;

use YukataRm\Laravel\Request\Facade\Manager;
use YukataRm\Laravel\Request\Facade\Input;

/**
 * Facade Service Provider
 * 
 * @package YukataRm\Laravel\Request\Provider
 */
class FacadeServiceProvider extends ServiceProvider
{
    /**
     * register Facade
     * 
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Input::class, function () {
            return new Manager();
        });
    }
}
