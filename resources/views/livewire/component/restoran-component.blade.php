<div class="pt-5" style="margin-top: 5rem;">

  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="pt-5 halal-pattern2" id="destination">
    <div class="container">
      <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4">
        <img src="{{ asset('user') }}/assets/img/dest/shape.svg" alt="destination" />
      </div>
      <div class="mb-7 text-center">
        <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Daftar Semua Restoran</h3>
      </div>
      <div class="row">
        <!-- Kotak Pencarian -->
        <div class="container mb-4">
          <input type="text" wire:model.live="search" class="form-control" placeholder="Cari restoran...">
        </div>


        @forelse ($restaurants as $restaurant)
          <div class="col-md-4 mb-4">
            <div class="card overflow-hidden shadow">
              <img class="card-img-top" src="{{ asset('images/restaurant.jpg') }}" alt="{{ $restaurant->nama }}" />
              <div class="card-body py-4 px-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                  <h4 class="text-secondary fw-medium">
                    <a class="link-900 text-decoration-none stretched-link" href="#!">{{ $restaurant->nama }}</a>
                  </h4>
                </div>
                <div class="d-flex align-items-center">
                  <img src="{{ asset('user') }}/assets/img/dest/navigation.svg" style="margin-right: 14px"
                    width="20" alt="navigation" />
                  <span class="fs-0 fw-medium">Lihat Rute</span>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p>Tidak ada restoran yang ditemukan.</p>
          </div>
        @endforelse

      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
        {{ $restaurants->links() }}
      </div>
    </div><!-- end of .container-->
  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->
</div>
