<?php

namespace Zvermafia\TransliterationLaravel\Facades;

use Zvermafia\TransliterationLaravel\TransliteratorServiceProvider;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool exists(string $view)
 * @method static \Illuminate\Contracts\View\View file(string $path, array $data = [], array $mergeData = [])
 * @method static \Illuminate\Contracts\View\View make(string $view, array $data = [], array $mergeData = [])
 * @method static mixed share(array|string $key, $value = null)
 * @method static array composer(array|string $views, \Closure|string $callback)
 * @method static array creator(array|string $views, \Closure|string $callback)
 * @method static \Illuminate\Contracts\View\Factory addNamespace(string $namespace, string|array $hints)
 * @method static \Illuminate\Contracts\View\Factory replaceNamespace(string $namespace, string|array $hints)
 *
 * @see \Illuminate\View\Factory
 */
class TransliteratorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TransliteratorServiceProvider::SERVICE_NAME;
    }
}
