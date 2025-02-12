    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5 halal-pattern2" id="destination">

      <div class="container">
        <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4"><img
            src="{{ asset('user') }}/assets/img/dest/shape.svg" alt="destination" /></div>
        <div class="mb-7 text-center">
          <h5 class="text-secondary">pilihan terbaik untukmu </h5>

          @if (!empty($lokasi))
            <p>beberapa lokasi terdekat <strong>{{ $lokasi['description'] }}</strong></p>
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Rekomendasi Untukmu</h3>
          @else
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Top Destinasi</h3>
          @endif
        </div>
        <div class="row">


          @forelse ($wisatas as $wisata)
            <div class="col-md-4 mb-4">
              <div class="card overflow-hidden shadow">
                <img class="card-img-top" src="{{ asset('images/wisata-halal.jpg') }}" alt="Rome, Italty" />
                <div class="card-body py-4 px-3">
                  <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                    <h4 class="text-secondary fw-medium"><a class="link-900 text-decoration-none stretched-link"
                        href="#!">{{ $wisata->nama }}</a></h4>
                  </div>
                  <div class="d-flex align-items-center"> <img src="{{ asset('user') }}/assets/img/dest/navigation.svg"
                      style="margin-right: 14px" width="20" alt="navigation" /><span class="fs-0 fw-medium">Lihat
                      Rute</span></div>
                </div>
              </div>
            </div>
          @empty
          @endforelse



        </div>
      </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
