<section class="pt-5 pt-md-9" id="map-lokasi">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <div class="text-center mb-4">
          <h2>Lokasi Destinasi</h2>
          <p class="text-secondary">Visualisasi peta lokasi Anda dan destinasi wisata yang direkomendasikan</p>
        </div>
        <div class="card shadow-sm overflow-hidden">
          <div class="card-body p-0">
            <div id="map" style="height: 400px; width: 100%;" wire:ignore></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      let map;
      let userMarker;

      // Initialize the map
      function initMap(userLocation, recommendedLocations) {
        const mapOptions = {
          center: {
            lat: parseFloat(userLocation.lat),
            lng: parseFloat(userLocation.lng)
          },
          zoom: 12,
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Add user location marker
        if (userMarker) {
          userMarker.setMap(null); // Remove existing marker
        }
        userMarker = new google.maps.Marker({
          position: {
            lat: parseFloat(userLocation.lat),
            lng: parseFloat(userLocation.lng)
          },
          map: map,
          title: 'Lokasi Anda',
          icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png', // Custom icon for user location
        });

        // Add recommended locations markers
        recommendedLocations.forEach(location => {
          new google.maps.Marker({
            position: {
              lat: parseFloat(location.lat),
              lng: parseFloat(location.long)
            },
            map: map,
            title: location.nama,
            icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png', // Custom icon for destinations
          });
        });
      }

      // Initialize map on page load
      document.addEventListener("DOMContentLoaded", function() {
        if (typeof window.initMap === "function") {
          const userLocation = {
            lat: {{ $userLat }},
            lng: {{ $userLong }}
          };
          const recommendedLocations = @json($recommendedLocations);
          window.initMap(userLocation, recommendedLocations);
        }
      });

      // Listen for Livewire event to update map
      window.addEventListener('mapDataUpdated', event => {
        const {
          userLocation,
          recommendedLocations
        } = event.detail;

        // Update the map with new data
        if (typeof window.initMap === "function") {
          window.initMap(userLocation, recommendedLocations);
        }
      });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
  @endpush
</section>
