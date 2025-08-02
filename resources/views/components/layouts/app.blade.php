<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Dashboard - SB Admin</title>
		<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
		<link href="{{ asset('sb') }}/css/styles.css" rel="stylesheet" />
		<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
		@livewireStyles
		@stack('css')
</head>

<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
				<!-- Navbar Brand-->
				<a class="navbar-brand ps-3" href="index.html">Pasraman Saraswati</a>
				<!-- Sidebar Toggle-->
				<button class="btn btn-link btn-sm order-lg-0 me-lg-0 order-1 me-4" id="sidebarToggle" href="#!"><i
								class="fas fa-bars"></i></button>
				<!-- Navbar Search-->
				<form class="d-none d-md-inline-block form-inline me-md-3 my-md-0 my-2 me-0 ms-auto">
						<div class="input-group">
								<input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
										aria-describedby="btnNavbarSearch" />
								<button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
						</div>
				</form>
				<!-- Navbar-->
				<!-- Assuming this is the relevant part of your admin layout -->
				<ul class="navbar-nav ms-md-0 me-lg-4 me-3 ms-auto">
						<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
										aria-expanded="false">
										<i class="fas fa-user fa-fw"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
										{{-- <li><a class="dropdown-item" href="#!">Activity Log</a></li> --}}
										<li>
												<hr class="dropdown-divider" />
										</li>
										<li>
												<form action="{{ route('admin.logout') }}" method="POST">
														@csrf
														<button type="submit" class="dropdown-item">Logout</button>
												</form>
										</li>
								</ul>
						</li>
				</ul>
		</nav>
		<div id="layoutSidenav">
				<div id="layoutSidenav_nav">
						<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
								<div class="sb-sidenav-menu">
										<div class="nav">
												<div class="sb-sidenav-menu-heading">Core</div>
												<a class="nav-link" href="{{ route('admin.dashboard') }}">
														<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
														Dashboard
												</a>
												<div class="sb-sidenav-menu-heading">Master</div>
												@php
														$masterMenu = [
														    ['route' => 'admin.pelajaran', 'label' => 'Data Pelajaran'],
														    ['route' => 'admin.kelas', 'label' => 'Data Kelas'],
														    ['route' => 'admin.siswa', 'label' => 'Data Siswa'],
														    ['route' => 'admin.guru', 'label' => 'Data Guru'],
														];

														// Cek jika salah satu route di menu Master aktif
														$isMasterActive = collect($masterMenu)->pluck('route')->contains(fn($route) => Route::is($route));
												@endphp

												<a class="nav-link {{ $isMasterActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
														data-bs-target="#collapseMaster" aria-expanded="{{ $isMasterActive ? 'true' : 'false' }}"
														aria-controls="collapseMaster">
														<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
														Master Data
														<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
												</a>

												<div class="{{ $isMasterActive ? 'show' : '' }} collapse" id="collapseMaster" aria-labelledby="headingOne"
														data-bs-parent="#sidenavAccordion">
														<nav class="sb-sidenav-menu-nested nav">
																@foreach ($masterMenu as $menu)
																		<a class="nav-link {{ Route::is($menu['route']) ? 'active' : '' }}"
																				href="{{ route($menu['route']) }}">
																				{{ $menu['label'] }}
																		</a>
																@endforeach
														</nav>
												</div>

												<div class="sb-sidenav-menu-heading">Pembayaran</div>
												@php
														$pembayaranMenu = [
														    ['route' => 'admin.komponen', 'label' => 'Komponen Biaya'],
														    ['route' => 'admin.biaya-pendidikan', 'label' => 'Biaya Pendidikan'],
														    ['route' => 'admin.pembayaran', 'label' => 'Pembayaran'],
														];

														// Cek jika salah satu route di menu Pembayaran aktif
														$isPembayaranActive = collect($pembayaranMenu)->pluck('route')->contains(fn($route) => Route::is($route));
												@endphp

												<a class="nav-link {{ $isPembayaranActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
														data-bs-target="#collapsePembayaran" aria-expanded="{{ $isPembayaranActive ? 'true' : 'false' }}"
														aria-controls="collapsePembayaran">
														<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
														Pembayaran
														<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
												</a>

												<div class="{{ $isPembayaranActive ? 'show' : '' }} collapse" id="collapsePembayaran"
														aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
														<nav class="sb-sidenav-menu-nested nav">
																@foreach ($pembayaranMenu as $menu)
																		<a class="nav-link {{ Route::is($menu['route']) ? 'active' : '' }}"
																				href="{{ route($menu['route']) }}">
																				{{ $menu['label'] }}
																		</a>
																@endforeach
														</nav>
												</div>

												<div class="sb-sidenav-menu-heading">Manajemen Kelas & Siswa</div>
												@php
														$kelasSiswaMenu = [
														    ['route' => 'admin.guru-pelajaran', 'label' => 'Guru Pelajaran'],
														    ['route' => 'admin.pelajaran-siswa', 'label' => 'Pelajaran Siswa'],
														    ['route' => 'admin.nilai', 'label' => 'Manejemen Nilai'],
														    ['route' => 'admin.jadwal', 'label' => 'Manejemen Jadwal'],
														];

														// Cek jika salah satu route di menu Kelas & Siswa aktif
														$isKelasSiswaActive = collect($kelasSiswaMenu)->pluck('route')->contains(fn($route) => Route::is($route));
												@endphp

												<a class="nav-link {{ $isKelasSiswaActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
														data-bs-target="#collapseKelasSiswa" aria-expanded="{{ $isKelasSiswaActive ? 'true' : 'false' }}"
														aria-controls="collapseKelasSiswa">
														<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
														Kelas & Siswa
														<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
												</a>

												<div class="{{ $isKelasSiswaActive ? 'show' : '' }} collapse" id="collapseKelasSiswa"
														aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
														<nav class="sb-sidenav-menu-nested nav">
																@foreach ($kelasSiswaMenu as $menu)
																		<a class="nav-link {{ Route::is($menu['route']) ? 'active' : '' }}"
																				href="{{ route($menu['route']) }}">
																				{{ $menu['label'] }}
																		</a>
																@endforeach
														</nav>
												</div>


										</div>
								</div>
								<div class="sb-sidenav-footer">
										<div class="small">Logged in as:</div>
										Admin
								</div>
						</nav>
				</div>
				<div id="layoutSidenav_content">
						<main>
								{{ $slot }}
						</main>
						<footer class="bg-light mt-auto py-4">
								<div class="container-fluid px-4">
										<div class="d-flex align-items-center justify-content-between small">
												<div class="text-muted">Copyright &copy; Your Website 2023</div>
												<div>
														<a href="#">Privacy Policy</a>
														&middot;
														<a href="#">Terms &amp; Conditions</a>
												</div>
										</div>
								</div>
						</footer>
				</div>
		</div>
		@livewireScripts
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
		</script>
		<script src="{{ asset('sb') }}/js/scripts.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="{{ asset('sb') }}/assets/demo/chart-area-demo.js"></script>
		<script src="{{ asset('sb') }}/assets/demo/chart-bar-demo.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
				crossorigin="anonymous"></script>
		<script src="{{ asset('sb') }}/js/datatables-simple-demo.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		@stack('css')
</body>

</html>
