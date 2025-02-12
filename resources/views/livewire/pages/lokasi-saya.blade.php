<div class="row" style="padding: 10rem 0;">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title text-center mb-4">Lokasi Saya</h5>
      @if ($savedLocation)
        <div class="mb-4">
          <p class="text-muted">Lokasi terakhir Anda:</p>
          <strong>{{ $savedLocation['description'] }}</strong>
          <small class="d-block text-secondary">
            Latitude: {{ $savedLocation['latitude'] }}, Longitude: {{ $savedLocation['longitude'] }}
          </small>
        </div>
        <div id="map" style="height: 400px; width: 100%; border-radius: 8px; overflow: hidden;"></div>
      @else
        <p class="text-center text-muted">Tidak ada lokasi yang disimpan.</p>
      @endif
    </div>
  </div>
  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const savedLocation = JSON.parse(sessionStorage.getItem('selectedLocation'));

        if (savedLocation) {
          // Kirim data ke Livewire
          window.Livewire.dispatch('setSavedLocation', {
            location: savedLocation
          });

          // Gunakan fungsi initMap yang sudah ada
          window.initMap({
            lat: parseFloat(savedLocation.latitude),
            lng: parseFloat(savedLocation.longitude)
          });
          // alert("oke");
          // console.log(savedLocation.latitude, savedLocation.longitude);

        }


      });
      log
      document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('message.processed', (message, component) => {
          if (document.getElementById('map')) {
            console.log("✅ Elemen map ditemukan setelah Livewire render.");
          } else {
            console.error("❌ Elemen map masih tidak ditemukan.");
          }
        });
      });
    </script>
  @endpush
</div>
