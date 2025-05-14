<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    protected $location;
    public function __construct(Location $location)
    {
        $this->location = $location;
    }
}