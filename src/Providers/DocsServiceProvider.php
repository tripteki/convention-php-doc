<?php

namespace Tripteki\Docs\Providers;

use Tripteki\Docs\Console\Commands\UnGenerateDocsCommand;
use Tripteki\Docs\Console\Commands\GenerateDocsCommand;
use Illuminate\Support\ServiceProvider;

class DocsServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    public static $loadConfig = true;

    /**
     * @return bool
     */
    public static function shouldLoadConfig()
    {
        return static::$loadConfig;
    }

    /**
     * @return void
     */
    public static function ignoreConfig()
    {
        static::$loadConfig = false;
    }

    /**
     * @return void
     */
    public function register()
    {
        if ($this->app->isProduction()) {

            $this->app["config"]->set("l5-swagger.documentations", []);
        }
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerConfigs();
        $this->registerCommands();
        $this->registerPublishers();
    }

    /**
     * @return void
     */
    protected function registerConfigs()
    {
        if (static::shouldLoadConfig()) {

            $this->app["config"]->set("l5-swagger", []);
            $this->mergeConfigFrom(__DIR__."/../../config/swagger.php", "l5-swagger");
        }
    }

    /**
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {

            $this->commands(
            [
                UnGenerateDocsCommand::class,
                GenerateDocsCommand::class,
            ]);
        }
    }

    /**
     * @return void
     */
    protected function registerPublishers()
    {
        $this->publishes(
        [
            __DIR__."/../../config/swagger.php" => config_path("l5-swagger.php"),
        ],

        "tripteki-laravelphp-docs-config");

        $this->publishes(
        [
            __DIR__."/../../resources/views" => config("l5-swagger.defaults.paths.views"),
        ],

        "tripteki-laravelphp-docs-views");
    }
};
