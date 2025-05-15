@extends('pages.layouts.dashboard')

@section('title', 'Create Location')

@section('content')

<div class="container-fluid container-lg">
   
    <div class="flex d-flex flex-row justify-content-between align-items-center w-100 py-4 bg-light shadow-sm">
        <div class="container">
            <h1 class="mb-0 text-primary">Create Location</h1>
        </div>
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
            <input type="double" class="form-control" id="latitude" name="latitude">
        </div>
        <div class="form-group mb-3">
            <label for="longitude">Longitude</label>
            <input type="double" class="form-control" id="longitude" name="longitude">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>
</div>

@endsection