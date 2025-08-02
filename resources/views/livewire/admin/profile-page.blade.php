<main class="main py-5">
		<!-- Section Title -->
		<div class="section-title container" data-aos="fade-up">
				<h2>Profil Admin</h2>
				<p>Informasi dan Pengaturan Akun</p>
		</div><!-- End Section Title -->

		<div class="container" data-aos="fade-up" data-aos-delay="100">
				<div class="row gy-4">
						<div class="col-12 pb-5" data-aos="fade-up" data-aos-delay="100">
								<div class="card">
										<div class="card-body">
												<h5 class="card-title">Informasi Profil</h5>
												@if (session('message'))
														<div class="alert alert-success" role="alert">
																{{ session('message') }}
														</div>
												@endif
												<table class="table">
														<tbody>
																<tr>
																		<th scope="row">Nama</th>
																		<td>{{ $user->name }}</td>
																</tr>
																<tr>
																		<th scope="row">Email</th>
																		<td>{{ $user->email }}</td>
																</tr>
																<!-- Tambahkan kolom lain jika ada, misalnya role -->
																<!-- <tr>
																																				<th scope="row">Role</th>
																																				<td>{{ $user->role ?? 'Admin' }}</td>
																																</tr> -->
														</tbody>
												</table>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPassword">
														Ganti Password
												</button>
										</div>
								</div>
						</div>
				</div>
		</div>

		<!-- Modal Ganti Password -->
		<div wire:ignore.self class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel"
				aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title" id="modalPasswordLabel">Ganti Password</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
										<form wire:submit.prevent="updatePassword">
												<div class="mb-3">
														<label for="current_password" class="form-label">Password Lama</label>
														<input type="password" class="form-control @error('current_password') is-invalid @enderror"
																id="current_password" wire:model="current_password">
														@error('current_password')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>
												<div class="mb-3">
														<label for="password" class="form-label">Password Baru</label>
														<input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
																wire:model="password">
														@error('password')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>
												<div class="mb-3">
														<label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
														<input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation">
												</div>
												<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
										</form>
								</div>
								<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
								</div>
						</div>
				</div>
		</div>
</main>

@push('css')
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
				integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush

@push('js')
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"
				integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script>
				document.addEventListener('livewire:initialized', () => {
						window.addEventListener('close-modal', event => {
								const modal = bootstrap.Modal.getInstance(document.getElementById(event.detail.id));
								if (modal) modal.hide();
						});
				});
		</script>
@endpush
