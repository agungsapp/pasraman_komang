<section id="contact" class="contact section">
		<div class="container" data-aos="fade-up" data-aos-delay="100">
				<div class="row">
						<div class="contact-content col-6 mx-auto">
								<div class="contact-form-container" data-aos="fade-up" data-aos-delay="400">
										<h3>Login </h3>
										<p>Silahkan login untuk dapat mengakses data pembayaran dan nilai</p>

										<form wire:submit.prevent="login" class="php-email-form">
												<div class="form-group mt-3">
														<div class="col-12 form-group mt-md-0 mt-3">
																<label for="email">Email</label>
																<input type="email" class="form-control" wire:model="email" id="email"
																		placeholder="siswa@gmail.com" required>
																@error('email')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<label for="password">Password</label>
																<input type="password" class="form-control" wire:model="password" id="password"
																		placeholder="Masukkan password" required>
																@error('password')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
														</div>
												</div>
												<div class="my-3">
														<div class="loading" wire:loading>Loading...</div>
														@if (session()->has('error'))
																<div class="error-message">{{ session('error') }}</div>
														@endif
														@if (session()->has('message'))
																<div class="sent-message">{{ session('message') }}</div>
														@endif
												</div>
												<div class="form-submit">
														<button type="submit">Login</button>
												</div>
										</form>
								</div>
						</div>
				</div>
		</div>
</section>
