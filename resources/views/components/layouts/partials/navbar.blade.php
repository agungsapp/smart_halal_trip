<nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top py-5 d-block"
  data-navbar-on-scroll="data-navbar-on-scroll">
  <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images') }}/logo2.png"
        height="44" alt="logo" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
        class="navbar-toggler-icon"> </span></button>
    <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#rekomendasi">Cari
            Rekomendasi</a>
        </li>
        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page"
            href="{{ route('wisata') }}">Daftar Wisata</a>
        </li>
        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page"
            href="{{ route('restoran') }}">Daftar Restoran</a>
        </li>

        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#!">Login</a>
        </li>
        <li class="nav-item px-3 px-xl-4"><a class="btn btn-dark order-1 order-lg-0 fw-medium" href="#!">Daftar</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
