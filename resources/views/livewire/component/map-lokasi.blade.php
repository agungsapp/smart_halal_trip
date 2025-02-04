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
    </script>
  @endpush

</section>
