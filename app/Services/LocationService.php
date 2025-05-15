<?php

namespace App\Services;

use App\Repositories\Interfaces\LocationRepositoryInterface;


class LocationService
{
    protected $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getAllLocations()
    {
        return $this->locationRepository->getAllLocations();
    }

    public function getLocationById($id)
    {
        return $this->locationRepository->getLocationById($id);
    }

    public function createLocation(array $data)
    {
        return $this->locationRepository->createLocation($data);
    }

    public function updateLocation(array $data, $id)
    {
        return $this->locationRepository->updateLocation($data, $id);
    }

    public function deleteLocation($id)
    {
        return $this->locationRepository->deleteLocation($id);
    }

}   