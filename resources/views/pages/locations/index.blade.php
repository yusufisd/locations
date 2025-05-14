@extends('pages.layouts.dashboard')

@section('title', 'Locations')

@section('content')

<div class="container-fluid container-lg ">
    <div class="flex d-flex flex-row justify-content-between align-items-center w-100">
        <div class=" p-5">
            <h1>Locations</h1>
        </div>
        <div class=" p-5">
            <a href="{{ route('locations.create') }}" class="btn btn-primary">Create Location</a>
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
                        <a href="{{ route('locations.edit', $location->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>


@endsection