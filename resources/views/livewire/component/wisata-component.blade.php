<div class="pt-5" style="margin-top: 5rem;">

		<!-- ============================================-->
		<!-- <section> begin ============================-->
		<section class="halal-pattern2 pt-5" id="destination">
				<div class="container">
						<div class="position-absolute start-100 translate-middle-x d-none d-xl-block ms-xl-n4 bottom-0">
								<img src="{{ asset('user') }}/assets/img/dest/shape.svg" alt="destination" />
						</div>
						<div class="mb-7 text-center">
								<h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Daftar Semua Wisata</h3>
						</div>
						<div class="row">
								<!-- Kotak Pencarian -->
								<div class="container mb-4">
										<input type="text" wire:model.live="search" class="form-control" placeholder="Cari destinasi wisata...">
								</div>


								@forelse ($wisatas as $wisata)
										<div class="col-md-4 mb-4">
												<div class="card overflow-hidden shadow">
														<img class="card-img-top" src="{{ asset('images/wisata-halal.jpg') }}" alt="{{ $wisata->nama }}" />
														<div class="card-body px-3 py-4">
																<div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
																		<h4 class="text-secondary fw-medium"><a class="link-900 text-decoration-none stretched-link"
																						target="_blank"
																						href="https://www.google.com/maps/search/?api=1&query={{ $wisata->lat }},{{ $wisata->long }}">{{ $wisata->nama }}</a>
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
												<p>Tidak ada destinasi wisata yang ditemukan.</p>
										</div>
								@endforelse

						</div>

						<!-- Pagination -->
						<div class="d-flex justify-content-center mt-4">
								{{-- {{ $wisatas->links() }} --}}
								{{ $wisatas->links('vendor.pagination.custom') }}
						</div>
				</div><!-- end of .container-->
		</section>
		<!-- <section> close ============================-->
		<!-- ============================================-->
</div>
