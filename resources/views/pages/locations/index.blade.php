@extends('pages.layouts.dashboard')

@section('title', 'Locations')

@section('content')

<div class="container-fluid container-lg ">

    <div class="flex d-flex flex-row justify-content-between align-items-center w-100 py-4 bg-light shadow-sm">
        <div class="container">
            <h1 class="mb-0 text-primary">Locations</h1>
        </div>
        <div class="flex d-flex flex-row justify-content-between align-items-center w-100">
            <div class="container text-end">
                <a href="{{ route('locations.create') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-list me-2"></i> Create Location
                </a>
            </div>
            <div class="container text-end">
                <a href="{{ route('locations.route.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-list me-2"></i>View Route
                </a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Color</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider bg-light">
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->color }}</td>
                    <td>{{ $location->latitude }}</td>
                    <td>{{ $location->longitude }}</td>
                    <td>
                        <div class="flex d-flex flex-row justify-content-between align-items-center gap-2 px-4 py-1">
                            <a href="{{ route('locations.detail', $location->id) }}">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('locations.edit', $location->id) }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ route('locations.destroy', $location->id) }}">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>


@endsection