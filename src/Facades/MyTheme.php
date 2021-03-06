<?php namespace Xiaogouxo\LaravelTheme\Facades;

use Illuminate\Support\Facades\Facade;

class MyTheme extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'xiaogouxo.themes';
    }
}
