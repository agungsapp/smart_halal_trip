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
														class="btn btn-success btn-lg me-md-4 mb-md-0 primary-btn-shadow mb-3 border-0" href="#destination"
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


		@livewire('component.feedback-component')

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
		@livewire('component.testimoni-component')
		<!-- <section> close ============================-->
		<!-- ============================================-->





</div>
