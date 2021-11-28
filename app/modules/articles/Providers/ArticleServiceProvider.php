<?php

namespace Articles\Providers;

use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $ds=DIRECTORY_SEPARATOR;
        $moduleName='articles';
        config([
            'articles'=>FacadesFile::getRequire(__DIR__.$ds.'..'.$ds.'config'.$ds.'route.php')
            ]);
    //    $this->loadRoutesFrom(__DIR__.$ds.'..'.$ds.'routes'.$ds.'admin'.$ds.'api.php');
    //    $this->loadRoutesFrom(__DIR__.$ds.'..'.$ds.'routes'.$ds.'admin'.$ds.'web.php');
    //    $this->loadViewsFrom(__DIR__.$ds.'..'.$ds.'resources'.$ds.'views',$moduleName);
    //    $this->loadMigrationsFrom(__DIR__.$ds.'..'.$ds.'database'.$ds.'migrations',$moduleName);
    //    $this->loadTranslationsFrom(__DIR__.$ds.'..'.$ds.'resources'.$ds.'lang',$moduleName);
        $this->loadRoutesFrom(loadRoute('api',$moduleName));
        $this->loadRoutesFrom(loadRoute('web',$moduleName));

        $this->loadViewsFrom(loadViews($moduleName),$moduleName);
        $this->loadMigrationsFrom(loadMigrations($moduleName));
        $this->loadTranslationsFrom(loadTranslations($moduleName),$moduleName);
    }
}


