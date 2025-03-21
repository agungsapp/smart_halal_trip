				<!-- ============================================-->
				<!-- <section> begin ============================-->
				<section class="halal-pattern2 pt-5" id="destination">

				<div class="container">
				<div class="position-absolute start-100 translate-middle-x d-none d-xl-block ms-xl-n4 bottom-0"><img
				src="{{ asset('user') }}/assets/img/dest/shape.svg" alt="destination" /></div>
				<div class="mb-7 text-center">
				<h5 class="text-secondary">pilihan terbaik untukmu </h5>
				{{-- <h5>{{ Storage::url('foto-wisata') }}</h5> --}}


				@if (!empty($lokasi))
				<p>beberapa lokasi terdekat <strong>{{ $lokasi['description'] }}</strong></p>
				<h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Rekomendasi Untukmu</h3>
		@else
				<h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Top Destinasi</h3>
				@endif
				</div>
				<div class="row">

				{{-- test --}}
				{{-- {{ $wisatas[0]->image ? Storage::url($wisatas[0]->image) : asset('images/wisata-halal.jpg') }} --}}

				@forelse ($wisatas as $wisata)
				<div class="col-md-4 mb-4">
				<div class="card overflow-hidden shadow">
				<img class="card-img-top card-image"
				src="{{ $wisata->image ? Storage::url($wisata->image) : asset('images/wisata-halal.jpg') }}"
				alt="Rome, Italty" />
				<div class="card-body px-3 py-4">
				<div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
				<h4 class="text-secondary fw-medium"><a class="link-900 text-decoration-none stretched-link"
				target="_blank"
				href="https://www.google.com/maps/search/?api=1&query={{ $wisata->lat }},{{ $wisata->long }}">{{ $wisata->nama }}</a>
				</h4>
				</div>
				<div class="mb-1">
				<span class="badge bg-primary text-white">{{ $wisata->jenis->nama }}</span>
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
