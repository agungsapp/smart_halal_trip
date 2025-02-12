<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-5" id="destination">
  <div class="container">
    <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4">
      <img src="{{ asset('user/assets/img/dest/shape.svg') }}" alt="destination" />
    </div>
    <div class="mb-7 text-center">
      <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Dimana anda sekarang?</h3>
    </div>
    <div class="row">
      <div class="card bg-white shadow-sm">
        <div class="card-body">
          <!-- Input Pencarian -->
          <div class="mb-3">
            <label for="search" class="form-label">Cari Lokasi</label>
            <input type="text" wire:model="query" wire:input.debounce.500ms="searchLocations"
              class="form-control form-control-lg" placeholder="Ketik nama lokasi..." />
          </div>

          <!-- Hasil Pencarian -->
          @if (!empty($locations))
            <div class="list-group">
              @foreach ($locations as $location)
                <button type="button" class="list-group-item list-group-item-action py-3"
                  onclick="selectLocation('{{ $location['display_name'] }}', '{{ $location['lat'] }}', '{{ $location['lon'] }}')">
                  <strong>{{ explode(',', $location['display_name'])[0] }}</strong>
                  <small class="d-block text-secondary">{{ $location['display_name'] }}</small>
                </button>
              @endforeach
            </div>
          @else
            <p class="text-muted">Mulai ketik untuk mencari lokasi...</p>
          @endif
        </div>
      </div>
    </div>
  </div><!-- end of .container-->


  <script>
    // Fungsi untuk menyimpan latitude dan longitude ke session browser dan Laravel
    function selectLocation(displayName, latitude, longitude) {
      console.log("Lokasi dipilih:", {
        displayName,
        latitude,
        longitude
      });

      // Data lokasi
      const location = {
        description: displayName,
        latitude: latitude,
        longitude: longitude,
      };

      // Simpan ke session storage (JavaScript)
      sessionStorage.setItem('selectedLocation', JSON.stringify(location));

      // Kirim data ke Livewire untuk disimpan ke session Laravel
      window.Livewire.dispatch('saveLocationToSession', {
        location: location
      });

      // Reset input pencarian
      const searchInput = document.querySelector('input[wire\\:model="query"]');
      if (searchInput) {
        searchInput.value = ''; // Kosongkan input
      }

      // Tampilkan notifikasi
      alert(`Lokasi "${displayName}" telah disimpan dengan latitude: ${latitude}, longitude: ${longitude}`);
    }
  </script>
</section>
<!-- <section> close ============================-->
<!-- ============================================-->
