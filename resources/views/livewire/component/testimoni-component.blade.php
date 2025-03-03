<section id="testimonial">
		<div class="container">
				<div class="row">
						<div class="col-lg-5">
								<div class="mb-8 text-start">
										<h5 class="text-secondary">Testimonials</h5>
										<h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Apa kata mereka tentang layanan kami?
										</h3>
								</div>
						</div>
						<div class="col-lg-1"></div>
						<div class="col-lg-6">
								<div class="ps-lg-0 pe-7 ps-5">
										<div class="carousel slide carousel-fade position-static" id="testimonialIndicator" data-bs-ride="carousel">
												<!-- Carousel Indicators -->
												<div class="carousel-indicators">
														@foreach ($testimonis as $index => $testimoni)
																<button type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="{{ $index }}"
																		{{ $index == 0 ? 'class=active aria-current=true' : '' }}
																		aria-label="Testimonial {{ $index }}"></button>
														@endforeach
												</div>

												<!-- Carousel Items -->
												<div class="carousel-inner">
														@forelse($testimonis as $index => $testimoni)
																<div class="carousel-item position-relative {{ $index == 0 ? 'active' : '' }}">
																		<div class="card shadow" style="border-radius:10px;">

																				<div class="card-body p-4">
																						<p class="fw-medium mb-4">"{{ $testimoni->ulasan }}"</p>
																						<h5 class="text-secondary">{{ $testimoni->nama }}</h5>
																						<p class="fw-medium fs--1 mb-0">{{ $testimoni->kota_asal }}</p>
																				</div>
																		</div>
																		<div class="card position-absolute z-index--1 w-100 h-100 top-0 mb-3 shadow-sm"
																				style="border-radius:10px;transform:translate(25px, 25px)"></div>
																</div>
														@empty
																<div class="carousel-item position-relative active">
																		<div class="card shadow" style="border-radius:10px;">
																				<div class="position-absolute translate-middle start-0 top-0">
																						<img class="rounded-circle fit-cover" src="{{ asset('user/assets/img/testimonial/user1.jpeg') }}"
																								height="65" width="65" alt="" />
																				</div>
																				<div class="card-body p-4">
																						<p class="fw-medium mb-4">"Belum ada testimoni untuk ditampilkan."</p>
																						<h5 class="text-secondary">-</h5>
																						<p class="fw-medium fs--1 mb-0">-</p>
																				</div>
																		</div>
																		<div class="card position-absolute z-index--1 w-100 h-100 top-0 mb-3 shadow-sm"
																				style="border-radius:10px;transform:translate(25px, 25px)"></div>
																</div>
														@endforelse
												</div>

												<!-- Carousel Navigation -->
												<div
														class="carousel-navigation d-flex flex-column flex-between-center position-absolute top-lg-50 translate-middle-y z-index-1 me-lg-0 bottom-0 end-0 me-3"
														style="height:60px;width:20px;">
														<button class="carousel-control-prev position-static" type="button"
																data-bs-target="#testimonialIndicator" data-bs-slide="prev">
																<img src="{{ asset('user/assets/img/icons/up.svg') }}" width="16" alt="icon" />
														</button>
														<button class="carousel-control-next position-static" type="button"
																data-bs-target="#testimonialIndicator" data-bs-slide="next">
																<img src="{{ asset('user/assets/img/icons/down.svg') }}" width="16" alt="icon" />
														</button>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</section>
