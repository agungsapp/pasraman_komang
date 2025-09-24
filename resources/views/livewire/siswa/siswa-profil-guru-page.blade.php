<div class="container mt-4 py-5">
		<h1 class="mb-4 text-center" data-aos="fade-up" data-aos-delay="100">Profil Guru</h1>

		@if ($errors->has('guru') || $errors->has('id_guru'))
				<div class="alert alert-danger" data-aos="fade-up" data-aos-delay="200">
						{{ $errors->first('guru') ?: $errors->first('id_guru') }}
				</div>
		@elseif ($guru)
				<div class="row justify-content-center">
						<div class="col-lg-6 col-md-8">
								<div class="card" data-aos="fade-up" data-aos-delay="300">
										<div class="card-header bg-light text-center">
												<img src="{{ $guru->photo ? asset('storage/' . $guru->photo) : asset('siswa/img/person/person-f-4.webp') }}"
														alt="{{ $guru->name }}" class="img-fluid img-thumbnail rounded-circle"
														style="width: 120px; height: 120px; object-fit: cover;" loading="lazy">
												<h5 class="mb-0 mt-2">{{ $guru->name }}</h5>
												<span class="text-muted">Guru</span>
										</div>
										<div class="card-body">
												<div class="rating mb-3 text-center">
														@for ($i = 0; $i < 5; $i++)
																<i class="bi {{ $i < ($guru->rating ?? 0) ? 'bi-star-fill' : 'bi-star' }}"></i>
														@endfor
												</div>
												<p>
														<strong>Deskripsi:</strong>
														{{ $guru->deskripsi ?? 'Pengajar berpengalaman yang berdedikasi untuk membantu siswa mencapai potensi maksimal mereka.' }}
												</p>
												<p><strong>Email:</strong> {{ $guru->email }}</p>
												@if ($guru->pelajarans && $guru->pelajarans->isNotEmpty())
														<p><strong>Pelajaran yang Diajarkan:</strong></p>
														<ul class="list-group list-group-flush">
																@foreach ($guru->pelajarans as $pelajaran)
																		<li class="list-group-item">- {{ $pelajaran->nama_pelajaran }}</li>
																@endforeach
														</ul>
												@else
														<p><strong>Pelajaran:</strong> Belum ada pelajaran yang ditugaskan.</p>
												@endif
										</div>
										<div class="card-footer text-center">
												<i class="bi bi-chat-quote-fill text-muted"></i>
										</div>
								</div>
						</div>
				</div>
		@else
				<div class="alert alert-info text-center" data-aos="fade-up" data-aos-delay="200">
						Tidak ada data guru yang tersedia.
				</div>
		@endif

		<div class="mt-4 text-center" data-aos="fade-up" data-aos-delay="400">
				<a href="/home#pengajar" class="btn btn-primary btn-sm">Kembali ke Daftar Guru</a>
		</div>
</div>

@push('css')
		{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
@endpush

@push('js')
		<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
		<script>
				AOS.init();
		</script>
@endpush
