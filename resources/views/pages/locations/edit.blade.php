@extends('pages.layouts.dashboard')

@section('title', 'Edit Location')

@section('content')

<div class="container-fluid container-lg">
    <div class="container p-5">
        <h1>Edit Location</h1>
    </div>

    <div class="container p-5 bg-light">
        <form action="{{ route('locations.update', $location->id) }}" method="post">
            @csrf
            @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $location->name }}">
        </div>
        <div class="form-group mb-3">
            <label for="color">Color (Hex)</label>
            <input type="text" class="form-control" placeholder="#000000" id="color" name="color" value="{{ $location->color }}">
        </div>
        <div class="form-group mb-3">
            <label for="latitude">Latitude</label>
            <input type="number" class="form-control" id="latitude" name="latitude" value="{{ $location->latitude }}">
        </div>
        <div class="form-group mb-3">
            <label for="longitude">Longitude</label>
            <input type="number" class="form-control" id="longitude" name="longitude" value="{{ $location->longitude }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
</div>

@endsection