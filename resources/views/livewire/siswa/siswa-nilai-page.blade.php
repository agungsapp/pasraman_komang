<main class="main">
		<!-- Section Title -->
		<div class="section-title container">
				<h2>Data Nilai</h2>
				<p>History Nilai</p>
		</div><!-- End Section Title -->

		<div class="container">
				<div class="row gy-4">
						<div class="col-12 pb-5">
								<div class="card">
										<div class="card-body">
												<table class="table">
														<thead>
																<tr>
																		<th scope="col">#</th>
																		<th>Pelajaran</th>
																		<th>Guru</th>
																		<th>Nilai</th>
																		<th>Keterangan</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($nilai as $item)
																		<tr>
																				<th scope="row">{{ $loop->iteration }}</th>
																				<td>{{ $item->pelajaran->nama_pelajaran ?? 'N/A' }}</td>
																				<td>{{ $item->guru->name ?? 'N/A' }}</td>
																				<td>{{ $item->nilai }}</td>
																				<td>{{ $item->keterangan ?? 'N/A' }}</td>
																				<td>
																						<button wire:click="detail({{ $item->id }})" type="button" class="btn btn-sm btn-info">
																								Detail
																						</button>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="6" class="text-center">Tidak ada data nilai</td>
																		</tr>
																@endforelse
														</tbody>
												</table>
										</div>
								</div>
						</div>
				</div>
		</div>

		<!-- Modal -->
		<div wire:ignore.self class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel"
				aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title" id="modalDetailLabel">Detail Nilai</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
										@if ($modalDetails)
												<p><strong>Siswa:</strong> {{ $modalDetails->siswa->nama ?? 'N/A' }}</p>
												<p><strong>Pelajaran:</strong> {{ $modalDetails->pelajaran->nama ?? 'N/A' }}</p>
												<p><strong>Guru:</strong> {{ $modalDetails->guru->name ?? 'N/A' }}</p>
												<p><strong>Nilai:</strong> {{ $modalDetails->nilai }}</p>
												<p><strong>Keterangan:</strong> {{ $modalDetails->keterangan ?? 'N/A' }}</p>
										@else
												<p>Tidak ada data untuk ditampilkan.</p>
										@endif
								</div>
								<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
								</div>
						</div>
				</div>
		</div>
</main>


@push('js')
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"
				integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script>
				document.addEventListener('livewire:initialized', () => {
						window.addEventListener('open-modal', event => {
								console.log(event.detail); // Debug event
								const modal = new bootstrap.Modal(document.getElementById(event.detail.id));
								modal.show();
						});

						window.addEventListener('close-modal', event => {
								const modal = bootstrap.Modal.getInstance(document.getElementById(event.detail.id));
								if (modal) modal.hide();
						});
				});
		</script>
@endpush
