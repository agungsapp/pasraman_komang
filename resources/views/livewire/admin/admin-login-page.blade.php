<div class="container">
		<div class="row justify-content-center">
				<div class="col-lg-5">
						<div class="card mt-5 rounded-lg border-0 shadow-lg">
								<div class="card-header d-flex gap-3">
										<img src="{{ asset('internal/logo.png') }}" class="img-fluid h-25 w-25" alt="">
										<div>
												<h3 class="font-weight-light mt-4">Login</h3>
												<p class="mt-1">Silahkan login untuk masuk ke sistem.</p>
										</div>
								</div>
								<div class="card-body">
										<form wire:submit.prevent="login">
												<div class="form-floating mb-3">
														<input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email"
																placeholder="name@example.com" wire:model.live="email" />
														<label for="inputEmail">Email address</label>
														@error('email')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>
												<div class="form-floating mb-3">
														<input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password"
																placeholder="Password" wire:model.live="password" />
														<label for="inputPassword">Password</label>
														@error('password')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>
												<div class="form-check mb-3">
														<input class="form-check-input" id="inputRememberPassword" type="checkbox" wire:model.live="remember" />
														<label class="form-check-label" for="inputRememberPassword">Remember Password</label>
												</div>

												<div class="form-floating mb-3">
														<p>belum punya akun ? hubungi admin web.</p>
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
