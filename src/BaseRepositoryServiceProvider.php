<?php namespace Kodebyraaet\Pattern;

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

        // Get the Data folder
        $dataFolder = app_path('Data');

        // Loop through all the folders in the Data folder
        foreach (glob($dataFolder.'/*', GLOB_ONLYDIR) as $folder) {

            // Get the basename of the Data-folder, this is the name of the Data object
            $name = basename($folder);

            // Check if this folder have a service provider
            if (file_exists($dataFolder.'/'.$name.'/'.$name.'ServiceProvider.php')) {

                // Register its service provider
                $this->app->register($namespace . 'Data\\' . $name . '\\' . $name . 'ServiceProvider');

            }
        
        }

    }
}
