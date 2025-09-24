<main class="main">
		<!-- Section Title -->
		<div class="section-title container">
				<h2>Data Pembayaran</h2>
				<p>History Pembayaran</p>
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
																		<th>Siswa</th>
																		<th>Jenjang</th>
																		<th>Tahun</th>
																		<th>Status</th>
																		<th>Total Jumlah</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($pembayaran as $item)
																		<tr>
																				<th scope="row">{{ $loop->iteration }}</th>
																				<td>{{ $item->siswa->nama }}</td>
																				<td>{{ $item->siswa->jenjang->nama }}</td>
																				<td>{{ $item->tahun }}</td>
																				<td>
																						<span class="badge {{ $item->status === 'lunas' ? 'bg-success' : 'bg-danger' }}">
																								{{ ucfirst($item->status) }}
																						</span>
																				</td>
																				<td>Rp {{ number_format($item->total_jumlah, 0, ',', '.') }}</td>
																				<td>
																						<button wire:click="detail({{ $item->id }})" type="button" class="btn btn-sm btn-info">
																								Detail
																						</button>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="7" class="text-center">Tidak ada data pembayaran</td>
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
										<h5 class="modal-title" id="modalDetailLabel">Detail Pembayaran</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
										@if ($modalDetails)
												<p><strong>Siswa:</strong> {{ $modalDetails->siswa->nama }}</p>
												<p><strong>Jenjang:</strong> {{ $modalDetails->siswa->jenjang->nama }}</p>
												<p><strong>Tahun:</strong> {{ $modalDetails->tahun }}</p>
												<p><strong>Status:</strong>
														<span class="badge {{ $modalDetails->status === 'lunas' ? 'bg-success' : 'bg-danger' }}">
																{{ ucfirst($modalDetails->status) }}
														</span>
												</p>
												<h6>Komponen Biaya:</h6>
												<table class="table-bordered table-striped table">
														<thead>
																<tr>
																		<th>Komponen Biaya</th>
																		<th>Jumlah</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($modalDetails->details as $detail)
																		<tr>
																				<td>{{ $detail->biayaPendidikan->komponenBiaya->nama ?? 'N/A' }}</td>
																				<td>Rp {{ number_format($detail->jumlah, 0, ',', '.') }}</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="2" class="text-center">Tidak ada detail pembayaran</td>
																		</tr>
																@endforelse
														</tbody>
														<tfoot>
																<tr>
																		<td class="text-end"><strong>Total:</strong></td>
																		<td><strong>Rp {{ number_format($modalDetails->details->sum('jumlah'), 0, ',', '.') }}</strong></td>
																</tr>
														</tfoot>
												</table>
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
				$(document).ready(function() {
						// alert("kena nih")
						window.addEventListener('open-modal', event => {
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
