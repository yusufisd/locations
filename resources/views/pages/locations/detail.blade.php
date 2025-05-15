@extends('pages.layouts.dashboard')

@section('title', 'Locations')

@section('content')

<div class="container-fluid container-lg">
    <div class="flex d-flex flex-row justify-content-between align-items-center w-100 py-4 bg-light shadow-sm">
        <div class="container">
            <h1 class="mb-0 text-primary">Location Detail</h1>
        </div>
        <div class="container text-end">
            <a href="{{ route('locations.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-list me-2"></i> Location List
            </a>
        </div>
    </div>
    <div class="container bg-light p-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        
                        <h5 class="card-title text-center mb-4">Location Details: {{ $location->name ?? '-' }}</h5>
                        <div class="row px-4">
                            <p class="card-title col-md-6 text-end mb-2">Name : </p>
                            <p class="card-text col-md-6 mb-2">{{ $location->name ?? '-' }}</p>
                        </div>
                        <div class="row">
                            <p class="card-title col-md-6 text-end">Color : </p>
                            <p class="card-text col-md-6">{{ $location->color ?? '-' }}</p>
                        </div>
                        <div class="row">
                            <p class="card-title col-md-6 text-end">Latitude : </p>
                            <p class="card-text col-md-6">{{ $location->latitude ?? '-' }}</p>
                        </div>
                        <div class="row">
                            <p class="card-title col-md-6 text-end">Longitude : </p>
                            <p class="card-text col-md-6">{{ $location->longitude ?? '-' }}</p>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let map;
    let initialLocation = @json($location); // Blade değişkenini JSON formatına çevirip JavaScript'e aktar

    async function initMap() {
      const { Map } = await google.maps.importLibrary("maps");
      map = new Map(document.getElementById("map"), {
        center: { lat: parseFloat(initialLocation.latitude), lng: parseFloat(initialLocation.longitude) },
      });

      addMarkersAndDrawRoute(initialLocation); // Fonksiyona doğrudan aktar
    }

    function addMarkersAndDrawRoute(locationData) { // Parametre adını daha anlamlı hale getirin
      const bounds = new google.maps.LatLngBounds();

      const pathCoordinates = [];

      console.log('locationData: ', locationData);

      const latLng = { lat: parseFloat(locationData.latitude), lng: parseFloat(locationData.longitude) };

        new google.maps.Marker({
          position: latLng,
          map: map,
          title: locationData.name || '',
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 8,
            fillColor: locationData.color || 'blue',
            fillOpacity: 0.8,
            strokeColor: 'black',
            strokeWeight: 1,
          },
        });

        pathCoordinates.push(latLng);
        bounds.extend(latLng);

      // Eğer birden fazla konum varsa (rota çizimi için), bu kısmı düzenlemeniz gerekebilir.
      // Şu anki kod tek bir konum için işaretleyici oluşturuyor.

      const polyline = new google.maps.Polyline({
        path: pathCoordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        map: map,
      });
      map.fitBounds(bounds);
    }

    initMap();
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=maps"></script>



@endsection