<?php namespace Xiaogouxo\LaravelTheme\Commands;

use Illuminate\Console\Command;
use Xiaogouxo\LaravelTheme\Facades\MyTheme;

class createPackage extends baseCommand
{
    protected $signature = 'theme:package {themeName?}';
    protected $description = 'Create a theme package';

    public function handle() {
        $themeName = $this->argument('themeName');

        if ($themeName == ""){
            $themes = array_map(function($theme){
                return $theme->name;
            }, MyTheme::all());
            $themeName = $this->choice('Select a theme to create a distributable package:', $themes);
        }
        $theme = MyTheme::find($themeName);

        $viewsPath = themes_path($theme->viewsPath);
        $assetPath = public_path($theme->assetPath);

        // Packages storage path
        $packagesPath = $this->packages_path();
        if(!$this->files->exists($packagesPath))
            mkdir($packagesPath);

        // Sanitize target filename
        $packageFileName = $theme->name;
        $packageFileName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $packageFileName);
        $packageFileName = mb_ereg_replace("([\.]{2,})", '', $packageFileName);
        $packageFileName = $this->packages_path("{$packageFileName}.theme.tar.gz");

        // Create Temp Folder
        $this->createTempFolder();

        // Copy Views+Assets to Temp Folder
        system("cp -r $viewsPath {$this->tempPath}/views");
        system("cp -r $assetPath {$this->tempPath}/asset");

        // Add viewsPath into theme.json file
        $themeJson = new \Xiaogouxo\LaravelTheme\themeManifest();
        $themeJson->loadFromFile("{$this->tempPath}/views/theme.json");
        $themeJson->set('views-path',$theme->viewsPath);
        $themeJson->saveToFile("{$this->tempPath}/views/theme.json");

        // Tar Temp Folder contents
        system("cd {$this->tempPath} && tar -cvzf $packageFileName .");

        // Del Temp Folder
        $this->clearTempFolder();

        $this->info("Package created at [$packageFileName]");
    }




}
