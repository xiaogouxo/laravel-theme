<?php namespace Xiaogouxo\LaravelTheme\Middleware;

use Closure;
use Xiaogouxo\LaravelTheme\Facades\MyTheme;

class setTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $themeName
     * @return mixed
     */
    public function handle($request, Closure $next, $themeName)
    {
        MyTheme::set($themeName);
        return $next($request);
    }
}
