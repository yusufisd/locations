<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        $locations = $this->locationService->getAllLocations();
        return view('pages.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('pages.locations.create');
    }

    public function store(Request $request)
    {
        $this->locationService->createLocation($request->all());
        return redirect()->route('locations.index');
    }

    public function edit($id)
    {
        $location = $this->locationService->getLocationById($id);
        return view('pages.locations.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $this->locationService->updateLocation($request->all(), $id);
        return redirect()->route('locations.index');
    }

    public function destroy($id)
    {
        $this->locationService->deleteLocation($id);
        return redirect()->route('locations.index');
    }

}
