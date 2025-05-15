@extends('pages.layouts.dashboard')

@section('title', 'Locations')

@section('content')


<div class="container-fluid container-lg">
    <div class="flex d-flex flex-row justify-content-between align-items-center w-100 py-4 bg-light shadow-sm">
        <div class="container">
            <h1 class="mb-0 text-primary">Route</h1>
        </div>
        <div class="container text-end">
            <a href="{{ route('locations.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-list me-2"></i> Location List
            </a>
        </div>
    </div>
    
    <div class="container p-5 bg-light">
        <div id="map" style="height: 500px;"></div>

    </div>
</div>

<script>
    let map;
    async function initMap() {
      //@ts-ignore
      const { Map } = await google.maps.importLibrary("maps");
  
      map = new Map(document.getElementById("map"), {
        center: { lat: 41.0082, lng: 28.9784 }, 
        zoom: 8, 
      });
  
      fetchLocations();
    }
  
    async function fetchLocations() {
      try {
        const response = await fetch('{{ route('locations.route') }}'); 
        const locations = await response.json();
  
        addMarkersAndDrawRoute(locations);
  
      } catch (error) {
        console.error("Konum verilerini alırken bir hata oluştu:", error);
      }
    }
  
    function addMarkersAndDrawRoute(locations) {
      const bounds = new google.maps.LatLngBounds(); 
  
      const pathCoordinates = []; 
  
      locations.forEach(location => {
        const latLng = { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) };
  
        new google.maps.Marker({
          position: latLng,
          map: map,
          title: location.name || '', 
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 8,
            fillColor: location.color || 'blue', 
            fillOpacity: 0.8,
            strokeColor: 'black',
            strokeWeight: 1,
          },
        });
  
        pathCoordinates.push(latLng);
        bounds.extend(latLng); 
      });
  
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
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp72eOQpjLanb-q35TCfpz44CC5GbRvTE&callback=initMap&libraries=maps"></script>

@endsection