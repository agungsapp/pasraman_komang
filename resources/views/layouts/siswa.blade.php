<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title>{{ $title ?? 'Pasraman Saraswati' }}</title>
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Favicons -->
		<link href="{{ asset('siswa') }}/img/favicon.png" rel="icon">
		<link href="{{ asset('siswa') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com" rel="preconnect">
		<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
		<link
				href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
				rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="{{ asset('siswa') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ asset('siswa') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="{{ asset('siswa') }}/vendor/aos/aos.css" rel="stylesheet">
		<link href="{{ asset('siswa') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
		<link href="{{ asset('siswa') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

		<!-- Main CSS File -->
		<link href="{{ asset('siswa') }}/css/main.css" rel="stylesheet">

		<!-- =======================================================
		* Template Name: College
		* Template URL: https://bootstrapmade.com/college-bootstrap-education-template/
		* Updated: Jun 19 2025 with Bootstrap v5.3.6
		* Author: BootstrapMade.com
		* License: https://bootstrapmade.com/license/
		======================================================== -->

		<style>
				.btn-site {
						background-color: #04415F;
						color: #FFF !important;
						padding: 12px 28px !important;
						border-radius: 50px;
						font-weight: bold;
				}

				.btn-profile {
						background-color: #04415F;
						color: #FFF !important;
						padding: 3px 28px !important;
						border-radius: 50px;
						font-weight: bold;
				}

				.btn-profile:hover {
						background-color: #fff;
						border: 2px solid #04415F;
						color: #04415F !important;
						padding: 3px 28px !important;
						border-radius: 50px;
						font-weight: bold;
				}
		</style>

		@stack('css')
</head>

<body class="index-page">

		<header id="header" class="header d-flex align-items-center sticky-top">
				<div
						class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-end">

						<a href="/" class="logo d-flex align-items-center me-auto">
								<!-- Uncomment the line below if you also wish to use an image logo -->
								<!-- <img src="{{ asset('siswa') }}/img/logo.webp" alt=""> -->
								<h1 class="sitename">{{ env('APP_NAME') }}</h1>
						</a>

						<nav id="navmenu" class="navmenu">
								<ul>
										<li><a href="/" class="active">Home</a></li>


										<li><a href="#about">Tentang Kami</a></li>
										<li><a href="#pengajar">Pengajar</a></li>

										@if (Auth::guard('siswa')->check())
												<li><a href="{{ route('pembayaran') }}">Pembayaran</a></li>
												<li><a href="{{ route('nilai') }}">Nilai</a></li>
										@endif

										{{-- <li class="dropdown"><a href="#"><span>Nilai</span> <i
																class="bi bi-chevron-down toggle-dropdown"></i></a>
												<ul>
														<li><a href="#">Dropdown 1</a></li>
														<li><a href="#">Dropdown 2</a></li>
														<li><a href="#">Dropdown 3</a></li>
														<li><a href="#">Dropdown 4</a></li>
												</ul>
										</li> --}}
										{{-- <li><a href="#">Kontak</a></li> --}}
										<li class="ms-auto">
												@if (Auth::guard('siswa')->check())
														<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
																@csrf
																<button type="submit" class="btn-site">Logout</button>
														</form>
												@else
														<a href="{{ route('login') }}" class="btn-site">Login</a>
												@endif
										</li>
								</ul>
								<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
						</nav>

				</div>
		</header>

		{{ $slot }}

		<footer id="footer" class="footer position-relative light-background">
				<div class="footer-top container">
						<div class="row gy-4">
								<div class="col-lg-12 footer-about">
										<a href="/" class="logo d-flex align-items-center">
												<span class="sitename">Pasraman Saraswati</span>
										</a>
										<div class="footer-contact pt-3">
												<p>Jl. Kamboja Raya No.10 B, Labuhan Dalam, Kec. Tj. Senang, Kota Bandar Lampung, Lampung 35141</p>
												<p><strong>Phone:</strong> <span>+62 21 1234 5678</span></p>
												<p><strong>Email:</strong> <span>info@pasraman.id</span></p>
										</div>
										<div class="social-links d-flex mt-4">
												<a href="https://instagram.com/pasraman.id"><i class="bi bi-instagram"></i></a>
												<a href="https://facebook.com/pasraman.id"><i class="bi bi-facebook"></i></a>
												<a href="https://whatsapp.com/pasraman.id"><i class="bi bi-whatsapp"></i></a>
										</div>
								</div>


						</div>
				</div>

				<div class="copyright container mt-4 text-center">
						<p>© <span>Copyright</span> <strong class="sitename px-1">Pasraman Saraswati Bandar Lampung</strong> <span>All
										Rights Reserved</span></p>

				</div>
		</footer>

		<!-- Scroll Top -->
		<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
						class="bi bi-arrow-up-short"></i></a>

		<!-- Preloader -->
		<div id="preloader"></div>

		<!-- Vendor JS Files -->
		<script src="{{ asset('siswa') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="{{ asset('siswa') }}/vendor/php-email-form/validate.js"></script>
		<script src="{{ asset('siswa') }}/vendor/aos/aos.js"></script>
		<script src="{{ asset('siswa') }}/vendor/swiper/swiper-bundle.min.js"></script>
		<script src="{{ asset('siswa') }}/vendor/purecounter/purecounter_vanilla.js"></script>
		<script src="{{ asset('siswa') }}/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
		<script src="{{ asset('siswa') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
		<script src="{{ asset('siswa') }}/vendor/glightbox/js/glightbox.min.js"></script>

		<!-- Main JS File -->
		<script src="{{ asset('siswa') }}/js/main.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		@stack('js')
</body>

</html>
