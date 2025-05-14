<?php
namespace App\Providers;

use App\Services\LocationService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Repositories\LocationRepository;

class LocationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }
}

