<section id="register" class="contact section">
		<div class="container" data-aos="fade-up" data-aos-delay="100">
				<div class="row">
						<div class="contact-content col-6 mx-auto">
								<div class="contact-form-container" data-aos="fade-up" data-aos-delay="400">
										<h3>Register</h3>
										<p>Silahkan daftar untuk membuat akun baru</p>

										<form wire:submit.prevent="register" class="php-email-form">
												<!-- Nama -->
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<label for="nama">Nama Lengkap</label>
																<input type="text" class="form-control" wire:model="nama" id="nama" placeholder="Nama Lengkap"
																		required>
																@error('nama')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>

												<!-- Email -->
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<label for="email">Email</label>
																<input type="email" class="form-control" wire:model="email" id="email"
																		placeholder="siswa@gmail.com" required>
																@error('email')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>

												<!-- Password -->
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

												<!-- Jenjang -->
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<label for="jenjang_id">Jenjang</label>
																<select class="form-control" wire:model="jenjang_id" id="jenjang_id" required>
																		<option value="">Pilih Jenjang</option>
																		@foreach ($jenjangs as $jenjang)
																				<option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
																		@endforeach
																</select>
																@error('jenjang_id')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>

												<!-- Nomor Orang Tua -->
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<label for="no_orang_tua">Nomor Telepon Orang Tua</label>
																<input type="text" class="form-control" wire:model="no_orang_tua" id="no_orang_tua"
																		placeholder="Nomor Telepon Orang Tua" required>
																@error('no_orang_tua')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>

												<!-- Alamat -->
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<label for="alamat">Alamat</label>
																<textarea class="form-control" wire:model="alamat" id="alamat" placeholder="Alamat" required></textarea>
																@error('alamat')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>

												<!-- Tanggal Lahir -->
												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<label for="tanggal_lahir">Tanggal Lahir</label>
																<input type="date" class="form-control" wire:model="tanggal_lahir" id="tanggal_lahir" required>
																@error('tanggal_lahir')
																		<span class="error-message">{{ $message }}</span>
																@enderror
														</div>
												</div>

												<div class="form-group mt-3">
														<div class="col-12 form-group">
																<p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
														</div>
												</div>

												<div class="my-3">
														<div class="loading" wire:loading>Loading...</div>
														@if (session()->has('message'))
																<div class="sent-message">{{ session('message') }}</div>
														@endif
														@if (session()->has('error'))
																<div class="error-message">{{ session('error') }}</div>
														@endif
												</div>

												<div class="form-submit">
														<button type="submit">Daftar</button>
												</div>
										</form>
								</div>
						</div>
				</div>
		</div>
</section>
