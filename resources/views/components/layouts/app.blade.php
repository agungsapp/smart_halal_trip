<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- ===============================================-->
		<!--    Document Title-->
		<!-- ===============================================-->
		<title>{{ $title ?? 'Smart Trip Halal' }}</title>


		<!-- ===============================================-->
		<!--    Favicons-->
		<!-- ===============================================-->
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('user') }}/assets/img/favicons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('user') }}/assets/img/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('user') }}/assets/img/favicons/favicon-16x16.png">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('user') }}/assets/img/favicons/favicon.ico">
		<link rel="manifest" href="{{ asset('user') }}/assets/img/favicons/manifest.json">
		<meta name="msapplication-TileImage" content="{{ asset('user') }}/assets/img/favicons/mstile-150x150.png">
		<meta name="theme-color" content="#ffffff">


		<!-- ===============================================-->
		<!--    Stylesheets-->
		<!-- ===============================================-->
		<link href="{{ asset('user') }}/assets/css/theme.css" rel="stylesheet" />

		<style>
				.card-image {
						width: 100%;
						height: 300px;
						object-fit: cover;
						object-position: center;
				}

				.halal-pattern {
						position: relative;
						z-index: 1;
				}

				.halal-pattern::before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-image: url('images/halal-pattern.jpg');
						background-repeat: no-repeat;
						background-size: cover;
						opacity: 0.4;
						/* Hanya background yang transparan */
						z-index: -1;
				}

				.halal-pattern2 {
						position: relative;
						z-index: 1;
				}

				.halal-pattern2::before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-image: url('images/halal-pattern2.webp');
						/* background-repeat: no-repeat; */
						background-size: contain;
						opacity: 0.1;
						/* Hanya background yang transparan */
						z-index: -1;
				}
		</style>

		@vite('resources/js/app.js')

		@livewireStyles
		@stack('styles')


</head>


<body>
		{{-- {{ $slot }} --}}
		<!-- ===============================================-->
		<!--    Main Content-->
		<!-- ===============================================-->
		<main class="main" id="top">


				{{-- navbar --}}
				@include('components.layouts.partials.navbar')

				{{ $slot }}

				{{-- footer --}}
				@include('components.layouts.partials.footer')




				<div class="bg-success py-4 text-center">
						<p class="fs--5 fw-bold mb-0 text-white">Gia Ayu Tari @ darmajaya </p>
				</div>
		</main>
		<!-- ===============================================-->
		<!--    End of Main Content-->
		<!-- ===============================================-->




		<!-- ===============================================-->
		<!--    JavaScripts-->
		<!-- ===============================================-->
		<script src="{{ asset('user') }}/vendors/@popperjs/popper.min.js"></script>
		<script src="{{ asset('user') }}/vendors/bootstrap/bootstrap.min.js"></script>
		<script src="{{ asset('user') }}/vendors/is/is.min.js"></script>
		<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
		<script src="{{ asset('user') }}/vendors/fontawesome/all.min.js"></script>
		<script src="{{ asset('user') }}/assets/js/theme.js"></script>

		<link
				href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
				rel="stylesheet">

		@livewireScripts
		@stack('scripts')
</body>

</html>
