<section class="pt-5 pt-md-9" id="rekomendasi">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-lg">
          <div class="card-body p-5">
            <div class="row mb-5">
              <div class="col-12">
                <h3>Cari Rekomendasi Wisata</h3>
              </div>
            </div>

            <!-- Peta OpenLayers -->
            <div id="map" style="height: 400px;"></div>

            <!-- Tombol Cari -->
            <div class="col-12 col-md-2 mt-3">
              <button class="btn btn-primary" wire:click="cariRekomendasi">Cari</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal untuk meminta izin lokasi -->
  <div class="modal fade {{ $lat == null ? 'show d-block' : '' }}" id="locationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Izinkan Akses Lokasi</h5>
        </div>
        <div class="modal-body">
          <p>Aplikasi ini membutuhkan akses lokasi Anda untuk memberikan rekomendasi wisata terbaik.</p>
          <button id="getLocation" class="btn btn-primary">Gunakan Lokasi Saya</button>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        console.log("DOM Loaded - Menampilkan peta dengan lokasi default.");

        // Load peta dengan default ke Bandar Lampung
        window.initMap({
          lat: -5.429,
          lng: 105.261
        }, []);

        // Event untuk memperbarui peta setelah mendapatkan lokasi
        Livewire.on('mapDataUpdated', (data) => {
          console.log('Memuat ulang peta dengan data baru:', data);
          window.initMap(data[0].userLocation, data[0].recommendedLocations);
        });

        // Tombol dapatkan lokasi
        document.getElementById("getLocation").addEventListener("click", function() {
          console.log("Tombol diklik, mencoba mendapatkan lokasi...");

          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
              function(position) {
                var userLat = position.coords.latitude;
                var userLong = position.coords.longitude;

                console.log("✅ Lokasi pengguna ditemukan:", userLat, userLong);

                // Kirim data ke Livewire
                Livewire.dispatch('setLocation', userLat, userLong);

                // Update peta dengan lokasi baru
                window.initMap({
                  lat: userLat,
                  lng: userLong
                }, []);

                // Tutup modal
                document.getElementById("locationModal").classList.remove("show", "d-block");
              },
              function(error) {
                console.error("❌ Geolocation Error:", error);
                alert("Gagal mendapatkan lokasi. Pastikan izin lokasi diaktifkan.");
              }
            );
          } else {
            alert("Geolocation tidak didukung oleh browser ini.");
          }
        });
      });
    </script>
  @endpush

</section>
