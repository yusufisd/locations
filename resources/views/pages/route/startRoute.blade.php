@extends('pages.layouts.dashboard')

@section('title', 'Route')

@section('content')

    <div class="container-fluid container-lg">
        <div class="d-flex justify-content-between align-items-center w-100 bg-light flex flex-row py-4 shadow-sm">
            <div class="container">
                <h1 class="text-primary mb-0">Calculate Route</h1>
            </div>
            <div class="container text-end">
                <a href="{{ route('locations.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-list me-2"></i> Location List
                </a>
            </div>
        </div>
        <div class="container">
            <form action="{{ route('locations.route.index') }}" method="post">
                @csrf
                <div class="row justify-content-center bg-light p-5">
                    <p class="">Please enter the start latitude and longitude to calculate the route</p>

                    <div class="row justify-content-center py-4">
                        <div class="col-md-6">
                            <label class="form-label" for="startLatitude">Start Latitude</label>
                            <input type="text" class="form-control" name="startLatitude" placeholder="41.0082">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="startLongitude">Start Longitude</label>
                            <input type="text" class="form-control" name="startLongitude" placeholder="28.9784">
                        </div>
                    </div>
                    <div class="col-md-12 text-end">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
