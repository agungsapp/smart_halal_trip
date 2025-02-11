<div>


  <section style="padding-top: 7rem;" class="halal-pattern">
    <div class="bg-holder" style="background-image:url(assets/img/hero/hero-bg.svg);">
    </div>
    <!--/.bg-holder-->

    <div class="container ">
      <div class="row align-items-center">
        <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 hero-img"
            src="{{ asset('user') }}/assets/img/hero/hero2.png" alt="hero-header" /></div>
        <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
          <h4 class="fw-bold text-success mb-3">Wisata Halal yang Nyaman & Terpercaya</h4>
          <h1 class="hero-title">Jelajahi & Nikmati Perjalanan Halal Tanpa Khawatir</h1>
          <p class="mb-4 fw-medium">Smart Halal Trip membantu Anda menemukan tempat wisata dan kuliner halal terbaik
            di
            Bandar Lampung.<br class="d-none d-xl-block" />Rencanakan perjalanan impian Anda dengan mudah!</p>
          <div class="text-center text-md-start"> <a
              class="btn btn-success btn-lg me-md-4 mb-3 mb-md-0 border-0 primary-btn-shadow" href="#!"
              role="button">Cari Rekomendasi</a>
          </div>
        </div>
      </div>
    </div>
  </section>



  {{-- cari rekomendasi --}}
  @livewire('component.cari-rekomendasi')

  {{-- top destinasi wisata --}}
  @livewire('component.top-destinasi')
  {{-- map lokasi komponen --}}
  {{-- @livewire('component.map-lokasi') --}}


  <!-- <section> begin ============================-->
  <section class="pt-5 pt-md-9 " id="service">

    <div class="container">
      <div class="position-absolute z-index--1 end-0 d-none d-lg-block"><img
          src="{{ asset('user') }}/assets/img/category/shape.svg" style="max-width: 200px" alt="service" /></div>
      <div class="mb-7 text-center">
        <h5 class="text-secondary">KATEGORI</h5>
        <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Fitur Rekomendasi Wisata Halal</h3>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-6 mb-6">
          <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
            <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('user') }}/assets/img/category/icon1.png"
                width="75" alt="Service" />
              <h4 class="mb-3">Destinasi Wisata</h4>
              <p class="mb-0 fw-medium">Rekomendasi tempat wisata halal yang nyaman dan ramah keluarga.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-6">
          <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
            <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('user') }}/assets/img/category/icon2.png"
                width="75" alt="Service" />
              <h4 class="mb-3">Kuliner Halal</h4>
              <p class="mb-0 fw-medium">Temukan restoran dan tempat makan dengan jaminan halal terbaik.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-6">
          <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
            <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('user') }}/assets/img/category/icon3.png"
                width="75" alt="Service" />
              <h4 class="mb-3">Akomodasi</h4>
              <p class="mb-0 fw-medium">Rekomendasi hotel dan penginapan dengan fasilitas ramah muslim.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-6">
          <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
            <div class="card-body p-xxl-5 p-4"> <img src="{{ asset('user') }}/assets/img/category/icon4.png"
                width="75" alt="Service" />
              <h4 class="mb-3">Transportasi</h4>
              <p class="mb-0 fw-medium">Pilihan transportasi terbaik untuk perjalanan wisata Anda.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->

  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->





  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section id="testimonial">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="mb-8 text-start">
            <h5 class="text-secondary">Testimonials</h5>
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Apa kata mereka tentang layanan
              kami?</h3>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6">
          <div class="pe-7 ps-5 ps-lg-0">
            <div class="carousel slide carousel-fade position-static" id="testimonialIndicator" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button class="active" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="0"
                  aria-current="true" aria-label="Testimonial 0"></button>
                <button type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="1"
                  aria-label="Testimonial 1"></button>
                <button type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="2"
                  aria-label="Testimonial 2"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item position-relative active">
                  <div class="card shadow" style="border-radius:10px;">
                    <div class="position-absolute start-0 top-0 translate-middle">
                      <img class="rounded-circle fit-cover" src="{{ asset('user') }}/assets/img/testimonial/user1.png"
                        height="65" width="65" alt="" />
                    </div>
                    <div class="card-body p-4">
                      <p class="fw-medium mb-4">"Sangat membantu! Saya jadi lebih mudah menemukan destinasi wisata
                        sesuai minat saya. Rekomendasinya juga akurat!"</p>
                      <h5 class="text-secondary">Budi Santoso</h5>
                      <p class="fw-medium fs--1 mb-0">Jakarta, Indonesia</p>
                    </div>
                  </div>
                  <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100"
                    style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                </div>
                <div class="carousel-item position-relative">
                  <div class="card shadow" style="border-radius:10px;">
                    <div class="position-absolute start-0 top-0 translate-middle">
                      <img class="rounded-circle fit-cover" src="{{ asset('user') }}/assets/img/testimonial/user2.png"
                        height="65" width="65" alt="" />
                    </div>
                    <div class="card-body p-4">
                      <p class="fw-medium mb-4">"Aplikasi ini sangat membantu dalam merencanakan liburan saya. Saya
                        menemukan tempat yang belum pernah saya kunjungi sebelumnya!"</p>
                      <h5 class="text-secondary">Dewi Lestari</h5>
                      <p class="fw-medium fs--1 mb-0">Bandung, Indonesia</p>
                    </div>
                  </div>
                  <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100"
                    style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                </div>
                <div class="carousel-item position-relative">
                  <div class="card shadow" style="border-radius:10px;">
                    <div class="position-absolute start-0 top-0 translate-middle">
                      <img class="rounded-circle fit-cover" src="{{ asset('user') }}/assets/img/testimonial/user3.png"
                        height="65" width="65" alt="" />
                    </div>
                    <div class="card-body p-4">
                      <p class="fw-medium mb-4">"Saya tidak menyangka sistem ini bisa merekomendasikan tempat yang
                        sesuai dengan keinginan saya! Sangat direkomendasikan!"</p>
                      <h5 class="text-secondary">Andi Wijaya</h5>
                      <p class="fw-medium fs--1 mb-0">Surabaya, Indonesia</p>
                    </div>
                  </div>
                  <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100"
                    style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                </div>
              </div>
              <div
                class="carousel-navigation d-flex flex-column flex-between-center position-absolute end-0 top-lg-50 bottom-0 translate-middle-y z-index-1 me-3 me-lg-0"
                style="height:60px;width:20px;">
                <button class="carousel-control-prev position-static" type="button"
                  data-bs-target="#testimonialIndicator" data-bs-slide="prev"><img
                    src="{{ asset('user') }}/assets/img/icons/up.svg" width="16" alt="icon" /></button>
                <button class="carousel-control-next position-static" type="button"
                  data-bs-target="#testimonialIndicator" data-bs-slide="next"><img
                    src="{{ asset('user') }}/assets/img/icons/down.svg" width="16" alt="icon" /></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="pt-6">
    <div class="container">
      <div class="py-8 px-5 position-relative text-center"
        style="background-color: rgba(223, 215, 249, 0.199);border-radius: 129px 20px 20px 20px;">
        <div class="position-absolute start-100 top-0 translate-middle ms-md-n3 ms-n4 mt-3">
          <img src="{{ asset('user') }}/assets/img/cta/send.png" style="max-width:70px;" alt="send icon" />
        </div>
        <div class="position-absolute end-0 top-0 z-index--1">
          <img src="{{ asset('user') }}/assets/img/cta/shape-bg2.png" width="264" alt="cta shape" />
        </div>
        <div class="position-absolute start-0 bottom-0 ms-3 z-index--1 d-none d-sm-block">
          <img src="{{ asset('user') }}/assets/img/cta/shape-bg1.png" style="max-width: 340px;" alt="cta shape" />
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <h2 class="text-secondary lh-1-7 mb-7">Dapatkan rekomendasi wisata terbaik & penawaran eksklusif
              langsung
              di email Anda!</h2>
            <form class="row g-3 align-items-center w-lg-75 mx-auto">
              <div class="col-sm">
                <div class="input-group-icon">
                  <input class="form-control form-little-squirrel-control" type="email"
                    placeholder="Masukkan email Anda" aria-label="email" />
                  <img class="input-box-icon" src="{{ asset('user') }}/assets/img/cta/mail.svg" width="17"
                    alt="mail" />
                </div>
              </div>
              <div class="col-sm-auto">
                <button class="btn btn-danger orange-gradient-btn fs--1">Dapatkan Rekomendasi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->


</div>
