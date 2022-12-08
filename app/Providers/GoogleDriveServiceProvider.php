<?php

namespace App\Providers;

use Exception;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Masbug\Flysystem\GoogleDriveAdapter;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws Exception
     */
    public function boot()
    {
        try {
            Storage::extend('google', function($app, $config) {
                $options = [];
                if (!empty($config['folderId'] ?? null)) {
                    $options['folderId'] = $config['folderId'];
                }
                $client = new Client();

                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);

                $service = new Drive($client);
                $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver  = new Filesystem($adapter);

                return new FilesystemAdapter($driver, $adapter);
            });
        } catch(Exception $e) {
            throw $e;
        }
    }
}
