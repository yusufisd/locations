<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationCreateRequest;
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

    public function detail($id)
    {
        $location = $this->locationService->getLocationById($id);
        return view('pages.locations.detail', compact('location'));
    }

    public function create()
    {
        return view('pages.locations.create');
    }

    public function store(LocationCreateRequest $request)
    {
        $this->locationService->createLocation($request->all());
        return redirect()->route('locations.index');
    }

    public function edit($id)
    {
        $location = $this->locationService->getLocationById($id);
        return view('pages.locations.edit', compact('location'));
    }

    public function update(LocationCreateRequest $request, $id)
    {
        $this->locationService->updateLocation($request->all(), $id);
        return redirect()->route('locations.index');
    }

    public function destroy($id)
    {
        $this->locationService->deleteLocation($id);
        return redirect()->route('locations.index');
    }

    public function route()
    {
        $locations = $this->locationService->getAllLocations();
        return view('pages.route.index', compact('locations'));
    }

    public function startRoute()
    {
        return view('pages.route.startRoute');
    }

    public function calculateRoute(Request $request)
    {
        $startLatitude = $request->input('startLatitude');
        $startLongitude = $request->input('startLongitude');
        $locations = $this->locationService->getAllLocations();
        return view('pages.route.index', compact('locations', 'startLatitude', 'startLongitude'));
    }
}
