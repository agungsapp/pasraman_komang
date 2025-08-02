<main class="main">

		<!-- Hero Section -->
		@livewire('siswa.home-page.hero-section')

		<!-- /Hero Section -->

		<!-- About Section -->
		<section id="about" class="about section">

				<div class="container" data-aos="fade-up" data-aos-delay="100">

						<div class="row align-items-center g-5">
								<div class="col-lg-6">
										<div class="about-content" data-aos="fade-up" data-aos-delay="200">
												<h3>Tentang Kami</h3>
												<h2>Menanamkan Nilai Dharma Sejak Dini</h2>
												<p>Pasraman Saraswati adalah lembaga pendidikan Hindu nonformal di Bandar Lampung yang berdiri untuk
														membentuk generasi muda Hindu yang berbudi luhur, memahami ajaran Tattwa, dan mampu melestarikan budaya
														leluhur seperti Aksara Bali dan seni tradisional.</p>

												<div class="timeline">
														<div class="timeline-item">
																<div class="timeline-dot"></div>
																<div class="timeline-content">
																		<h4>2008</h4>
																		<p>Pasraman Saraswati didirikan oleh Yayasan Saraswati untuk menjawab kebutuhan pendidikan Hindu bagi
																				anak-anak usia sekolah di Bandar Lampung.</p>
																</div>
														</div>

														<div class="timeline-item">
																<div class="timeline-dot"></div>
																<div class="timeline-content">
																		<h4>2012</h4>
																		<p>Meningkatkan jumlah siswa dan guru, serta mulai membuka kelas untuk jenjang SD, SMP, dan SMA.</p>
																</div>
														</div>

														<div class="timeline-item">
																<div class="timeline-dot"></div>
																<div class="timeline-content">
																		<h4>2017</h4>
																		<p>Mulai mengembangkan program berbasis digital seperti absensi online dan pelaporan nilai elektronik.
																		</p>
																</div>
														</div>

														<div class="timeline-item">
																<div class="timeline-dot"></div>
																<div class="timeline-content">
																		<h4>2024</h4>
																		<p>Meluncurkan sistem administrasi online yang terintegrasi dengan fitur pendaftaran, pembayaran, dan
																				pengelolaan nilai siswa.</p>
																</div>
														</div>
												</div>
										</div>
								</div>

								<div class="col-lg-6">
										<div class="about-image" data-aos="zoom-in" data-aos-delay="300">
												<img src="{{ asset('internal') }}/logo.png" alt="Pasraman Saraswati"
														style="max-height: 400px; max-width: 400px;" class="img-fluid rounded">

												<div class="mission-vision" data-aos="fade-up" data-aos-delay="400">
														<div class="mission">
																<h3>Misi Kami</h3>
																<p>Mendidik generasi muda Hindu agar memiliki pemahaman mendalam tentang ajaran Hindu Dharma, bersikap
																		santun, disiplin, dan mampu menjaga serta melestarikan budaya leluhur.</p>
														</div>

														<div class="vision">
																<h3>Visi Kami</h3>
																<p>Menjadi pasraman unggulan yang melahirkan generasi Hindu yang cerdas secara spiritual, intelektual,
																		dan emosional dalam menghadapi era modern.</p>
														</div>
												</div>
										</div>
								</div>
						</div>

						<div class="row mt-5">
								<div class="col-lg-12">
										<div class="core-values" data-aos="fade-up" data-aos-delay="500">
												<h3 class="mb-4 text-center">Nilai-Nilai Inti</h3>
												<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
														<div class="col">
																<div class="value-card">
																		<div class="value-icon">
																				<i class="bi bi-fire"></i>
																		</div>
																		<h4>Dharma</h4>
																		<p>Menjunjung tinggi kebenaran dan moralitas dalam setiap tindakan dan pikiran.</p>
																</div>
														</div>

														<div class="col">
																<div class="value-card">
																		<div class="value-icon">
																				<i class="bi bi-heart"></i>
																		</div>
																		<h4>Bhakti</h4>
																		<p>Menanamkan kecintaan dan pengabdian kepada Ida Sang Hyang Widhi Wasa melalui pembelajaran dan
																				sembahyang.</p>
																</div>
														</div>

														<div class="col">
																<div class="value-card">
																		<div class="value-icon">
																				<i class="bi bi-brightness-high"></i>
																		</div>
																		<h4>Susila</h4>
																		<p>Mengajarkan tata krama, etika, dan perilaku santun sebagai bagian dari kehidupan sehari-hari.</p>
																</div>
														</div>

														<div class="col">
																<div class="value-card">
																		<div class="value-icon">
																				<i class="bi bi-flower1"></i>
																		</div>
																		<h4>Budaya</h4>
																		<p>Melestarikan warisan budaya seperti Aksara Bali, seni tari, dan upacara adat dalam keseharian
																				pasraman.</p>
																</div>
														</div>
												</div>
										</div>
								</div>
						</div>

				</div>

		</section>
		<!-- /About Section -->


		<!-- Testimonials Section -->
		@livewire('siswa.home-page.testimoni-section')
		<!-- /Testimonials Section -->

		<!-- Stats Section -->
		<section id="stats" class="stats section">
				<div class="container" data-aos="fade-up" data-aos-delay="100">
						<div class="row justify-content-center">
								<div class="col-lg-8 text-center">
										<div class="intro-content" data-aos="fade-up" data-aos-delay="200">
												<h2 class="section-heading">Membentuk Generasi Berlandaskan Dharma dan Pengetahuan</h2>
												<p class="section-description">
														Pasraman Saraswati Hindu mengintegrasikan nilai-nilai Hindu, budaya Bali, dan pendidikan modern untuk
														mencetak generasi yang berakhlak mulia dan berpengetahuan luas.
												</p>
										</div>
								</div>
						</div>

						<div class="row g-4 mt-4">
								<div class="col-xl-3 col-lg-6 col-md-6">
										<div class="metric-card" data-aos="flip-left" data-aos-delay="300">
												<div class="metric-header">
														<div class="metric-icon-wrapper">
																<i class="bi bi-book-fill"></i>
														</div>
														<div class="metric-value">
																<span data-purecounter-start="0" data-purecounter-end="{{ \App\Models\Siswa::count() }}"
																		data-purecounter-duration="1" class="purecounter"></span>
														</div>
												</div>
												<div class="metric-info">
														<h4>Jumlah Siswa</h4>
														<p>Siswa aktif di Pasraman</p>
												</div>
										</div>
								</div>

								<div class="col-xl-3 col-lg-6 col-md-6">
										<div class="metric-card" data-aos="flip-left" data-aos-delay="400">
												<div class="metric-header">
														<div class="metric-icon-wrapper">
																<i class="bi bi-journal-text"></i>
														</div>
														<div class="metric-value">
																<span data-purecounter-start="0"
																		data-purecounter-end="{{ \App\Models\Pelajaran::where('is_active', 1)->count() }}"
																		data-purecounter-duration="1" class="purecounter"></span>
														</div>
												</div>
												<div class="metric-info">
														<h4>Pelajaran Aktif</h4>
														<p>Mata pelajaran Hindu dan akademik</p>
												</div>
										</div>
								</div>

								<div class="col-xl-3 col-lg-6 col-md-6">
										<div class="metric-card" data-aos="flip-left" data-aos-delay="500">
												<div class="metric-header">
														<div class="metric-icon-wrapper">
																<i class="bi bi-person-arms-up"></i>
														</div>
														<div class="metric-value">
																<span data-purecounter-start="0"
																		data-purecounter-end="{{ \App\Models\User::where('role', 'guru')->count() }}"
																		data-purecounter-duration="1" class="purecounter"></span>
														</div>
												</div>
												<div class="metric-info">
														<h4>Jumlah Guru</h4>
														<p>Pendidik berdedikasi untuk dharma</p>
												</div>
										</div>
								</div>

								<div class="col-xl-3 col-lg-6 col-md-6">
										<div class="metric-card" data-aos="flip-left" data-aos-delay="600">
												<div class="metric-header">
														<div class="metric-icon-wrapper">
																<i class="bi bi-award-fill"></i>
														</div>
														<div class="metric-value">
																<span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1"
																		class="purecounter"></span>+
														</div>
												</div>
												<div class="metric-info">
														<h4>Penghargaan</h4>
														<p>Prestasi dalam pendidikan Hindu</p>
												</div>
										</div>
								</div>
						</div>

						<div class="row mt-5">
								<div class="col-lg-12">
										<div class="highlights-section" data-aos="fade-up" data-aos-delay="700">
												<div class="row align-items-center">
														<div class="col-lg-6">
																<div class="highlights-content">
																		<h3 class="highlights-title">Menanamkan Nilai-Nilai Hindu untuk Masa Depan</h3>
																		<p class="highlights-text">
																				Kami mengajarkan Weda, yoga, dan budaya Bali untuk membentuk karakter mulia berdasarkan prinsip Tri
																				Hita Karana, harmoni dengan Tuhan, manusia, dan alam.
																		</p>
																		<div class="highlights-features">
																				<div class="feature-item" data-aos="fade-right" data-aos-delay="800">
																						<i class="bi bi-check-circle-fill"></i>
																						<span>Kurikulum berbasis Weda</span>
																				</div>
																				<div class="feature-item" data-aos="fade-right" data-aos-delay="900">
																						<i class="bi bi-check-circle-fill"></i>
																						<span>Guru ahli spiritual Hindu</span>
																				</div>
																				<div class="feature-item" data-aos="fade-right" data-aos-delay="1000">
																						<i class="bi bi-check-circle-fill"></i>
																						<span>Pembinaan karakter mulia</span>
																				</div>
																		</div>

																</div>
														</div>
														<div class="col-lg-6">
																<div class="highlights-gallery">
																		<div class="gallery-grid">
																				<div class="gallery-item large" data-aos="zoom-in" data-aos-delay="800">
																						<img src="https://jatengprov.go.id/wp-content/uploads/2023/03/IMG-20230323-WA0009.jpg"
																								alt="Upacara Hindu" class="img-fluid" loading="lazy">
																						<div class="gallery-overlay">
																								<h5>Upacara Keagamaan</h5>
																						</div>
																				</div>
																				{{-- <div class="gallery-item small" data-aos="zoom-in" data-aos-delay="900">
																						<img src="{{ asset('siswa/img/pasraman/yoga.webp') }}" alt="Yoga" class="img-fluid"
																								loading="lazy">
																						<div class="gallery-overlay">
																								<h6>Latihan Yoga</h6>
																						</div>
																				</div> --}}
																				<div class="gallery-item small" data-aos="zoom-in" data-aos-delay="1000">
																						<img
																								src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/67/2024/06/16/WhatsApp-Image-2024-06-16-at-212554-1859844550.jpeg"
																								alt="Belajar Weda" class="img-fluid" loading="lazy">
																						<div class="gallery-overlay">
																								<h6>Pembelajaran Weda</h6>
																						</div>
																				</div>
																		</div>
																</div>
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</section><!-- /Stats Section -->

		<!-- Recent News Section -->
		{{-- @livewire('siswa.home-page.news-section') --}}
		<!-- /Recent News Section -->

		<!-- Events Section -->
		{{-- @livewire('siswa.home-page.event-section') --}}
		<!-- /Events Section -->

</main>
