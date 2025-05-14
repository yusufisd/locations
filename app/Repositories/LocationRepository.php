<?php

namespace App\Repositories;

use App\Models\Location;
use App\Repositories\Interfaces\LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{
    protected $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function getAllLocations()
    {
        return $this->location->all();
    }

    public function getLocationById($id)
    {
        return $this->location->find($id);
    }

    public function createLocation(array $data)
    {
        return $this->location->create($data);
    }

    public function updateLocation(array $data, $id)
    {
        return $this->location->find($id)->update($data);
    }

    public function deleteLocation($id)
    {
        return $this->location->find($id)->delete();
    }
}
