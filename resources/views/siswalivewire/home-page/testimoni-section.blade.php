<section id="pengajar" class="testimonials section">
		<!-- Section Title -->
		<div class="section-title container" data-aos="fade-up">
				<h2>Pengajar Kami</h2>
				<p>Kenali tim pengajar profesional kami yang siap membimbing siswa menuju kesuksesan.</p>
		</div><!-- End Section Title -->

		<div class="container" data-aos="fade-up" data-aos-delay="100">
				<div class="testimonial-slider swiper init-swiper">
						<script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 4000
                    },
                    "slidesPerView": 1,
                    "spaceBetween": 30,
                    "navigation": {
                        "nextEl": ".swiper-button-next",
                        "prevEl": ".swiper-button-prev"
                    },
                    "breakpoints": {
                        "768": {
                            "slidesPerView": 2
                        },
                        "1200": {
                            "slidesPerView": 3
                        }
                    }
                }
            </script>

						<div class="swiper-wrapper">
								@forelse ($gurus as $index => $guru)
										<div class="swiper-slide">
												<div class="testimonial-item" data-aos="zoom-in" data-aos-delay="{{ 200 + $index * 100 }}">
														<div class="testimonial-header">
																<img
																		src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('siswa/img/person/person-f-4.webp') }}"
																		alt="{{ $guru->nama }}" class="img-fluid" loading="lazy">
																<div class="rating">
																		@for ($i = 0; $i < $guru->rating; $i++)
																				<i class="bi bi-star-fill"></i>
																		@endfor
																		@for ($i = $guru->rating; $i < 5; $i++)
																				<i class="bi bi-star"></i>
																		@endfor
																</div>
														</div>
														<div class="testimonial-body">
																<p>
																		{{ $guru->deskripsi ?? 'Pengajar berpengalaman yang berdedikasi untuk membantu siswa mencapai potensi maksimal mereka.' }}
																</p>
														</div>
														<div class="testimonial-footer">
																<h5>{{ $guru->nama }}</h5>
																<span>{{ $guru->jabatan }}</span>
																<div class="quote-icon">
																		<i class="bi bi-chat-quote-fill"></i>
																</div>
														</div>
												</div>
										</div>
								@empty
										<div class="swiper-slide">
												<div class="testimonial-item" data-aos="zoom-in" data-aos-delay="200">
														<div class="testimonial-body">
																<p>Belum ada data pengajar tersedia.</p>
														</div>
												</div>
										</div>
								@endforelse
						</div>

						<div class="swiper-navigation">
								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>
						</div>
				</div>
		</div>
</section>
