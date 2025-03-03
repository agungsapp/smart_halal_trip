<section class="{{ $showFeedback ? '' : 'd-none' }} pt-5" id="destination">
		<div class="container">
				<div class="position-absolute start-100 translate-middle-x d-none d-xl-block ms-xl-n4 bottom-0">
						<img src="{{ asset('user/assets/img/dest/shape.svg') }}" alt="destination" />
				</div>
				<div class="mb-7 text-center">
						<h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Tinggalkan Feedback</h3>
				</div>
				<div class="row">
						<div class="card bg-white shadow-sm">
								<div class="card-body">
										<!-- Tampilkan pesan sukses jika ada -->
										@if (session()->has('message'))
												<div class="alert alert-success">
														{{ session('message') }}
												</div>
										@endif

										<form wire:submit.prevent="submit" class="{{ $isSubmit ? 'd-none' : '' }}">
												<!-- Nama -->
												<div class="mb-3">
														<label for="nama" class="form-label">Nama</label>
														<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
																wire:model="nama">
														@error('nama')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>

												<!-- Kota Asal -->
												<div class="mb-3">
														<label for="kota_asal" class="form-label">Kota Asal</label>
														<input type="text" class="form-control @error('kota_asal') is-invalid @enderror" id="kota_asal"
																wire:model="kota_asal">
														@error('kota_asal')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>

												<!-- Ulasan -->
												<div class="mb-3">
														<label for="ulasan" class="form-label">Ulasan</label>
														<textarea class="form-control @error('ulasan') is-invalid @enderror" id="ulasan" rows="4" wire:model="ulasan"></textarea>
														@error('ulasan')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>

												<!-- Tombol Submit -->
												<button type="submit" class="btn btn-primary">Kirim Feedback</button>
										</form>
								</div>
						</div>
				</div>
		</div>
</section>
