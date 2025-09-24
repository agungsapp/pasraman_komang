<div class="container-fluid px-4">
		<h1 class="mt-4">Dashboard</h1>

		<div class="row mt-5">
				<div class="col-xl-3 col-md-6">
						<div class="card bg-primary mb-4 text-white">
								<div class="card-body">Data Siswa</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
										<a style="text-decoration: none;" class="small stretched-link text-white"
												href="{{ route('admin.siswa') }}">Lanjutkan</a>
										<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
						</div>
				</div>
				<div class="col-xl-3 col-md-6">
						<div class="card bg-warning mb-4 text-white">
								<div class="card-body">Data Komponen Biaya</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
										<a style="text-decoration: none;" class="small stretched-link text-white"
												href="{{ route('admin.komponen') }}">Lanjutkan</a>
										<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
						</div>
				</div>
				<div class="col-xl-3 col-md-6">
						<div class="card bg-success mb-4 text-white">
								<div class="card-body">Data Pembayaran</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
										<a style="text-decoration: none;" class="small stretched-link text-white"
												href="{{ route('admin.pembayaran') }}">Lanjutkan</a>
										<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
						</div>
				</div>
				<div class="col-xl-3 col-md-6">
						<div class="card bg-danger mb-4 text-white">
								<div class="card-body">Data Nilai</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
										<a style="text-decoration: none;" class="small stretched-link text-white"
												href="{{ route('admin.nilai') }}">Lanjutkan</a>
										<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
						</div>
				</div>
		</div>

</div>
