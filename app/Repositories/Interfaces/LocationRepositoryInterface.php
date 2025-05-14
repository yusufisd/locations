<?php

namespace App\Repositories\Interfaces;

interface LocationRepositoryInterface
{
    public function getAllLocations();
    public function getLocationById($id);
    public function createLocation(array $data);
    public function updateLocation(array $data, $id);
    public function deleteLocation($id);
}
