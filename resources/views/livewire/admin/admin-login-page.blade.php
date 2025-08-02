<div class="container">
		<div class="row justify-content-center">
				<div class="col-lg-5">
						<div class="card mt-5 rounded-lg border-0 shadow-lg">
								<div class="card-header d-flex gap-3">
										<img src="{{ asset('internal/logo.png') }}" class="img-fluid h-25 w-25" alt="Logo">
										<div>
												<h3 class="font-weight-light mt-4">Login</h3>
												<p class="mt-1">Silahkan login untuk masuk ke sistem.</p>
										</div>
								</div>
								<div class="card-body">
										<form wire:submit.prevent="login">
												<div class="form-floating mb-3">
														<input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email"
																placeholder="name@example.com" wire:model.live="email">
														<label for="inputEmail">Email address</label>
														@error('email')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>
												<div class="form-floating mb-3">
														<input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password"
																placeholder="Password" wire:model.live="password">
														<label for="inputPassword">Password</label>
														@error('password')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>
												<div class="form-check mb-3">
														<input class="form-check-input" id="inputRememberPassword" type="checkbox" wire:model.live="remember">
														<label class="form-check-label" for="inputRememberPassword">Remember Password</label>
												</div>
												<div class="form-floating mb-3">
														<p>Belum punya akun? Hubungi admin web.</p>
												</div>
												<div class="my-3">
														<div class="loading" wire:loading>Loading...</div>
												</div>
												<div class="d-flex align-items-center justify-content-end mb-0 mt-4">
														<button type="submit" class="btn btn-primary">Masuk</button>
												</div>
										</form>
								</div>
						</div>
				</div>
		</div>
</div>

@push('css')
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
				integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush

@push('js')
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"
				integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
				document.addEventListener('livewire:initialized', () => {
						window.Livewire.on('swal:alert', event => {
								console.log(event.detail); // Untuk debugging
								Swal.fire({
										title: event.detail.title,
										text: event.detail.text,
										icon: event.detail.icon,
										confirmButtonText: 'OK'
								});
						});
				});
		</script>
@endpush
