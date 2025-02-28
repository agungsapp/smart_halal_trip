<nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top d-block py-5"
		data-navbar-on-scroll="data-navbar-on-scroll">
		<div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images') }}/logo2.png"
								height="44" alt="logo" /></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
								class="navbar-toggler-icon"> </span></button>
				<div class="navbar-collapse border-top border-lg-0 mt-lg-0 collapse mt-4" id="navbarSupportedContent">
						<ul class="navbar-nav pt-lg-0 font-base align-items-lg-center align-items-start ms-auto pt-2">
								<li class="nav-item px-xl-4 px-3">
										<a class="nav-link fw-medium" aria-current="page" href="/home#destination">Cari Rekomendasi</a>
								</li>
								<li class="nav-item px-xl-4 px-3"><a class="nav-link fw-medium" aria-current="page"
												href="{{ route('wisata') }}">Daftar Wisata</a>
								</li>
								<li class="nav-item px-xl-4 px-3"><a class="nav-link fw-medium" aria-current="page"
												href="{{ route('restoran') }}">Daftar Restoran</a>
								</li>

								{{-- <li class="nav-item px-xl-4 px-3"><a class="nav-link fw-medium" aria-current="page" href="#!">Login</a>
								</li>
								<li class="nav-item px-xl-4 px-3"><a class="btn btn-dark order-lg-0 fw-medium order-1" href="#!">Daftar</a>
								</li> --}}


						</ul>
				</div>
		</div>
</nav>
