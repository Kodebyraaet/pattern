<?php

namespace Kodebyraaet\Pattern;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Support\ServiceProvider;

class BaseRepositoryServiceProvider extends ServiceProvider
{
    use AppNamespaceDetectorTrait;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Get the app namespace
        $namespace = $this->getAppNamespace();

        // Get the Entity folder
        $entityFolder = app_path('Entities');

        // Loop through all the folders in the Entity folder
        foreach (glob($entityFolder.'/*', GLOB_ONLYDIR) as $folder) {

            // Get the basename of the Entity-folder, this is the name of the Entity
            $name = basename($folder);

            // Check if this folder have a service provider
            if (file_exists($entityFolder.'/'.$name.'/'.$name.'ServiceProvider.php')) {

                // Register its service provider
                $this->app->register($namespace . 'Entities\\' . $name . '\\' . $name . 'ServiceProvider');
            }

        }
    }
}
