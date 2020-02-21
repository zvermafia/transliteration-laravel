<?php

namespace Zvermafia\TransliterationLaravel;

use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;
use Illuminate\Support\ServiceProvider;

class TransliteratorServiceProvider extends ServiceProvider
{
    /** @var string */
    public const SERVICE_NAME = 'zvermafia.transliterator';

    private const CONFIG_NAME = 'transliterator';
    private const CONFIG_PATH = __DIR__ . '/../config/';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishMyConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeMyConfig();

        $this->app->singleton(TransliteratorInterface::class, function () {
            $class = $this->getTransliteratorClass();

            return new {$class}();
        });

        $this->app->alias(TransliteratorInterface::class, self::SERVICE_NAME);
    }

    /**
     * Publish this package's configuration file to the application's own config directory.
     *
     * This will allow users of this package to easily override package's default configuration options.
     */
    private function publishMyConfig()
    {
        $this->publishes([
            self::CONFIG_PATH . self::CONFIG_NAME . '.php' => config_path(self::CONFIG_NAME . '.php'),
        ]);
    }

    /**
     * Merge this package's configuration file with the application's published copy.
     */
    private function mergeMyConfig()
    {
        $this->mergeConfigFrom(self::CONFIG_PATH . self::CONFIG_NAME . '.php', self::CONFIG_NAME);
    }

    /**
     * Get a transliterator class name from the config.
     *
     * @return string
     */
    private function getTransliteratorClass()
    {
        $service = config('transliterator.default');
        $service_class = config("transliterator.services.{$service}.class");

        return $service_class;
    }
}
