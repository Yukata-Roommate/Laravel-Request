<?php

namespace YukataRm\Laravel\Request\Provider;

use Illuminate\Support\ServiceProvider as Provider;

use YukataRm\Laravel\Request\Facade\Input;
use YukataRm\Laravel\Request\Facade\Manager;

/**
 * ServiceProvider
 * 
 * @package YukataRm\Laravel\Request\Provider
 */
class ServiceProvider extends Provider
{
    /**
     * Register Facade
     * 
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Input::class, function () {
            return new Manager();
        });
    }

    /**
     * publish config
     * 
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            $this->publicationsPath("config") => config_path("yukata-roommate"),
        ], "yukata-roommate");
    }

    /**
     * get path to publications
     * 
     * @param string|array<string> $path
     * @return string
     */
    private function publicationsPath(string|array $path): string
    {
        if (is_array($path)) $path = implode(DIRECTORY_SEPARATOR, $path);

        return __DIR__ . DIRECTORY_SEPARATOR . "publications" . DIRECTORY_SEPARATOR . $path;
    }
}
