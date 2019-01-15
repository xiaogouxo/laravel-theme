##加载
在composer.json中

    "require": {
        "xiaogouxo/laravel-theme": "^2.1.1"
    },     
    
##注册service和facade

    在providers中
    \Xiaogouxo\LaravelTheme\themeServiceProvider::class,
    
    在aliases中
    'MyTheme' =>\Xiaogouxo\LaravelTheme\Facades\MyTheme::class

##发布配置文件
    php artisan vendor:publish --provider="Xiaogouxo\LaravelTheme\themeServiceProvider" --tag=config
    
##使用
Check the [Documentation](https://github.com/Xiaogouxo/laravel-theme/wiki/1.-Installation)
