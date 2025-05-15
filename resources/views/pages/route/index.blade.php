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
  const startLat = {{ $startLatitude }}; // Blade'den gelen başlangıç enlemi
  const startLng = {{ $startLongitude }}; // Blade'den gelen başlangıç boylamı

  async function initMap() {
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("map"), {
      center: { lat: startLat, lng: startLng }, // Başlangıç noktasına göre haritayı ortala
      zoom: 8,
    });

    fetchLocations();
  }

  async function fetchLocations() {
    try {
      const response = await fetch('{{ route('locations.route') }}');
      const locations = await response.json();

      // Konumları başlangıç noktasına olan uzaklıklarına göre sırala
      locations.sort((a, b) => {
        const distanceA = calculateDistance(startLat, startLng, parseFloat(a.latitude), parseFloat(a.longitude));
        const distanceB = calculateDistance(startLat, startLng, parseFloat(b.latitude), parseFloat(b.longitude));
        return distanceA - distanceB;
      });

      addMarkersAndDrawRoute(locations);

    } catch (error) {
      console.error("Konum verilerini alırken bir hata oluştu:", error);
    }
  }

  function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Dünya yarıçapı km cinsinden
    const dLat = deg2rad(lat2 - lat1);
    const dLon = deg2rad(lon2 - lon1);
    const a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
      Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const d = R * c; // Mesafe km cinsinden
    return d;
  }

  function deg2rad(deg) {
    return deg * (Math.PI / 180)
  }

  function addMarkersAndDrawRoute(locations) {
    const bounds = new google.maps.LatLngBounds();
    let currentLatLng = { lat: parseFloat(startLat), lng: parseFloat(startLng) };

    // Başlangıç noktası için büyük bir işaretçi ekle
    new google.maps.Marker({
      position: currentLatLng,
      map: map,
      title: 'Başlangıç Noktası',
      icon: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 12, // Daha büyük boyut
        fillColor: 'green',
        fillOpacity: 0.8,
        strokeColor: 'black',
        strokeWeight: 2,
      },
    });
    bounds.extend(currentLatLng); // Başlangıç noktasını sınırlara dahil et

    locations.forEach(location => {
      const nextLatLng = { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) };

      new google.maps.Marker({
        position: nextLatLng,
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

      // Bir önceki nokta ile mevcut nokta arasında çizgi çiz
      const polyline = new google.maps.Polyline({
        path: [currentLatLng, nextLatLng],
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        map: map,
      });

      bounds.extend(nextLatLng); // Mevcut noktayı sınırlara dahil et
      currentLatLng = nextLatLng; // Bir sonraki çizgi için mevcut noktayı güncelle
    });

    map.fitBounds(bounds);
  }

  initMap();
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp72eOQpjLanb-q35TCfpz44CC5GbRvTE&callback=initMap&libraries=maps"></script>
@endsection
