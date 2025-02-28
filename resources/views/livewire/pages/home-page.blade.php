<div>


		<section style="padding-top: 7rem;" class="halal-pattern">
				<div class="bg-holder" style="background-image:url(assets/img/hero/hero-bg.svg);">
				</div>
				<!--/.bg-holder-->

				<div class="container">
						<div class="row align-items-center">
								<div class="col-md-5 col-lg-6 order-0 order-md-1 text-end"><img class="pt-md-0 hero-img pt-7"
												src="{{ asset('user') }}/assets/img/hero/hero2.png" alt="hero-header" /></div>
								<div class="col-md-7 col-lg-6 text-md-start py-6 text-center">
										<h4 class="fw-bold text-success mb-3">Wisata Halal yang Nyaman & Terpercaya</h4>
										<h1 class="hero-title">Jelajahi & Nikmati Perjalanan Halal Tanpa Khawatir</h1>
										<p class="fw-medium mb-4">Smart Halal Trip membantu Anda menemukan tempat wisata dan kuliner halal terbaik
												di
												Bandar Lampung.<br class="d-none d-xl-block" />Rencanakan perjalanan impian Anda dengan mudah!</p>
										<div class="text-md-start text-center"> <a
														class="btn btn-success btn-lg me-md-4 mb-md-0 primary-btn-shadow mb-3 border-0" href="#!"
														role="button">Cari Rekomendasi</a>
										</div>
								</div>
						</div>
				</div>
		</section>


		{{-- cari lokasi --}}
		@livewire('component.cari-lokasi')


		{{-- cari rekomendasi --}}
		{{-- @livewire('component.cari-rekomendasi') --}}

		{{-- top destinasi wisata --}}
		@livewire('component.top-destinasi')
		{{-- map lokasi komponen --}}
		@livewire('component.map-lokasi')


		<!-- <section> begin ============================-->
		<section class="pt-md-9 pt-5" id="service">

				<div class="container">
						<div class="position-absolute z-index--1 d-none d-lg-block end-0"><img
										src="{{ asset('user') }}/assets/img/category/shape.svg" style="max-width: 200px" alt="service" /></div>
						<div class="mb-7 text-center">
								<h5 class="text-secondary">KATEGORI</h5>
								<h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Fitur Rekomendasi Wisata Halal</h3>
						</div>
						<div class="row">


								<div class="col-lg-6 mb-6">
										<div class="card service-card shadow-hover rounded-3 align-items-center text-center">
												<div class="card-body p-xxl-5 p-4"> <img src="{{ asset('user') }}/assets/img/category/icon1.png"
																width="75" alt="Service" />
														<h4 class="mb-3">Destinasi Wisata</h4>
														<p class="fw-medium mb-0">Rekomendasi tempat wisata halal yang nyaman dan ramah keluarga.</p>
												</div>
										</div>
								</div>
								<div class="col-lg-6 mb-6">
										<div class="card service-card shadow-hover rounded-3 align-items-center text-center">
												<div class="card-body p-xxl-5 p-4"> <img src="{{ asset('user') }}/assets/img/category/icon2.png"
																width="75" alt="Service" />
														<h4 class="mb-3">Kuliner Halal</h4>
														<p class="fw-medium mb-0">Temukan restoran dan tempat makan dengan jaminan halal terbaik.</p>
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
										<div class="ps-lg-0 pe-7 ps-5">
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
																				<div class="position-absolute translate-middle start-0 top-0">
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
																		<div class="card position-absolute z-index--1 w-100 h-100 top-0 mb-3 shadow-sm"
																				style="border-radius:10px;transform:translate(25px, 25px)"> </div>
																</div>
																<div class="carousel-item position-relative">
																		<div class="card shadow" style="border-radius:10px;">
																				<div class="position-absolute translate-middle start-0 top-0">
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
																		<div class="card position-absolute z-index--1 w-100 h-100 top-0 mb-3 shadow-sm"
																				style="border-radius:10px;transform:translate(25px, 25px)"> </div>
																</div>
																<div class="carousel-item position-relative">
																		<div class="card shadow" style="border-radius:10px;">
																				<div class="position-absolute translate-middle start-0 top-0">
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
																		<div class="card position-absolute z-index--1 w-100 h-100 top-0 mb-3 shadow-sm"
																				style="border-radius:10px;transform:translate(25px, 25px)"> </div>
																</div>
														</div>
														<div
																class="carousel-navigation d-flex flex-column flex-between-center position-absolute top-lg-50 translate-middle-y z-index-1 me-lg-0 bottom-0 end-0 me-3"
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





</div>
