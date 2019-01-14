<?php namespace Xiaogouxo\LaravelTheme\Commands;

use Xiaogouxo\LaravelTheme\Facades\MyTheme;

class refreshCache extends baseCommand
{
    protected $signature = 'theme:refresh-cache';
    protected $description = 'Rebuilds the cache of "theme.json" files for each theme';

    public function handle()
    {
        // Rebuild Themes Cache
        MyTheme::rebuildCache();

        $this->info("Themes cache was refreshed. Currently theme caching is: " . (MyTheme::cacheEnabled() ? "ENABLED" : "DISABLED"));
    }

}
