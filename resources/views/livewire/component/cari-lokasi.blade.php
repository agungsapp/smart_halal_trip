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


          {{-- di sini saya ingin ada multiple select untuk memilih jenis contoh : wisata alam, wisata budaya, makanan halal --}}


          <!-- Template Blade -->
          <div class="mb-3" wire:ignore>
            <label for="jenis">Jenis (Optional)</label>
            <select class="form-select" id="jenis" multiple="multiple">
              <option value="">-- pilih jenis --</option>
              @forelse ($jenis as $jeni)
                <option value="{{ $jeni->id }}">{{ $jeni->nama }}</option>
              @empty
              @endforelse
            </select>
          </div>


          <!-- Input Pencarian -->
          <div class="mb-3">
            <label for="search" class="form-label">Cari lokasi anda berada</label>
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

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
      document.addEventListener('livewire:initialized', () => {
        // Inisialisasi Select2
        let select2 = $('#jenis').select2({
          placeholder: "Pilih jenis...",
          allowClear: true
        });

        // Menangani perubahan nilai Select2
        select2.on('change', function(e) {
          let data = $(this).val();
          @this.set('selectedJenis', data);
        });

        // Menangani reset dari Livewire
        Livewire.on('resetJenis', () => {
          $('#jenis').val(null).trigger('change');
        });
      });
    </script>
  @endpush

  <script>
    $(document).ready(function() {
      $('#jenis').select2();
    });
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
