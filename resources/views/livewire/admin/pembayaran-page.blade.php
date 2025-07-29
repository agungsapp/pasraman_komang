<div class="container-fluid px-4">
		<h1 class="text-capitalize mt-4">Data Pembayaran</h1>

		<div class="row mb-3">
				<div class="col-12">
						<div class="card">
								<div class="card-body">
										<!-- Form for Create/Update -->
										<form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-4 mb-3">
																<label for="siswa_id" class="form-label">Siswa</label>
																<select class="form-control @error('siswa_id') is-invalid @enderror" id="siswa_id"
																		wire:model.live="siswa_id">
																		<option value="">Pilih Siswa</option>
																		@foreach ($siswas as $siswa)
																				<option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->jenjang->nama }})</option>
																		@endforeach
																</select>
																@error('siswa_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-4 mb-3">
																<label for="tahun" class="form-label">Tahun Ajaran</label>
																<input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun"
																		wire:model="tahun" placeholder="Contoh: 2024/2025">
																@error('tahun')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-4 mb-3">
																<label for="status" class="form-label">Status</label>
																<select class="form-control @error('status') is-invalid @enderror" id="status" wire:model="status">
																		<option value="tagihan">Tagihan</option>
																		<option value="lunas">Lunas</option>
																</select>
																@error('status')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-12 mb-3">
																<h5>Detail Pembayaran</h5>
																@if ($jenjang_id && $biayaPendidikans->isEmpty())
																		<p class="text-danger">Tidak ada komponen biaya untuk jenjang ini. Silakan tambahkan di menu Biaya
																				Pendidikan.</p>
																@elseif ($biayaPendidikans->isEmpty())
																		<p class="text-muted">Pilih siswa untuk melihat komponen biaya.</p>
																@else
																		<table class="table-bordered table-striped table">
																				<thead>
																						<tr>
																								<th>Pilih</th>
																								<th>Komponen Biaya</th>
																								<th>Nominal</th>
																						</tr>
																				</thead>
																				<tbody>
																						@foreach ($biayaPendidikans as $index => $biaya)
																								<tr>
																										<td>
																												<input type="checkbox" class="form-check-input"
																														wire:model.live="details.{{ $index }}.checked">
																												<input type="hidden" wire:model="details.{{ $index }}.biaya_pendidikan_id">
																												<input type="hidden" wire:model="details.{{ $index }}.jumlah">
																										</td>
																										<td>{{ $biaya->komponenBiaya->nama }}</td>
																										<td>Rp {{ number_format($biaya->nominal, 0, ',', '.') }}</td>
																								</tr>
																						@endforeach
																				</tbody>
																				<tfoot>
																						<tr>
																								<td colspan="2" class="text-end"><strong>Total:</strong></td>
																								<td><strong>Rp {{ number_format($totalJumlah, 0, ',', '.') }}</strong></td>
																						</tr>
																				</tfoot>
																		</table>
																@endif
														</div>
												</div>
												<div class="d-flex gap-2">
														<button type="submit" class="btn btn-primary">
																{{ $editMode ? 'Update' : 'Simpan' }}
														</button>
														@if ($editMode)
																<button type="button" wire:click="cancelEdit" class="btn btn-secondary">
																		Batal
																</button>
														@endif
												</div>
										</form>
								</div>
						</div>
				</div>
		</div>

		<div class="row mb-3">
				<div class="col-12">
						<div class="card">
								<div class="card-body">
										<!-- Data Table -->
										<table id="pembayaranTable" class="table-striped table">
												<thead>
														<tr>
																<th>No</th>
																<th>Siswa</th>
																<th>Jenjang</th>
																<th>Tahun</th>
																<th>Status</th>
																<th>Total Jumlah</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse($pembayarans as $index => $item)
																<tr>
																		<td>{{ $loop->iteration }}</td>
																		<td>{{ $item->siswa->nama }}</td>
																		<td>{{ $item->siswa->jenjang->nama }}</td>
																		<td>{{ $item->tahun }}</td>
																		<td>{{ ucfirst($item->status) }}</td>
																		<td>Rp {{ number_format($item->details->sum('jumlah'), 0, ',', '.') }}</td>
																		<td>
																				<!-- Button trigger modal -->
																				<button type="button" class="btn btn-sm	 btn-primary" data-bs-toggle="modal"
																						data-bs-target="#modalDetail">
																						detail
																				</button>
																				<button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
																				<button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
																						onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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


		<!-- Modal -->
		<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title" id="modalDetailLabel">Modal title</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
										...
								</div>
								<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Save changes</button>
								</div>
						</div>
				</div>
		</div>
</div>

@push('js')
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
		<script>
				$(document).ready(function() {
						let table = $('#pembayaranTable').DataTable({
								"language": {
										"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
								},
								"pageLength": 10,
						});

						window.addEventListener('reload-table', function() {
								table.destroy();
								table = $('#pembayaranTable').DataTable({
										"language": {
												"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
										},
										"pageLength": 10,
								});
						});
				});
		</script>
@endpush
