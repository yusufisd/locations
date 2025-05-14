@extends('pages.layouts.dashboard')

@section('title', 'Create Location')

@section('content')

<div class="container-fluid container-lg">
    <div class="container p-5">
        <h1>Create Location</h1>
    </div>

    <div class="container p-5 bg-light">
        <form action="{{ route('locations.store') }}" method="post">
            @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group mb-3">
            <label for="color">Color (Hex)</label>
            <input type="text" class="form-control" placeholder="#000000" id="color" name="color">
        </div>
        <div class="form-group mb-3">
            <label for="latitude">Latitude</label>
            <input type="number" class="form-control" id="latitude" name="latitude">
        </div>
        <div class="form-group mb-3">
            <label for="longitude">Longitude</label>
            <input type="number" class="form-control" id="longitude" name="longitude">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>
</div>

@endsection