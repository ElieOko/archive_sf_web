<?php

namespace App\Providers;

use League\Flysystem\Filesystem;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;

class GoogleStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
       
      
    }
}
