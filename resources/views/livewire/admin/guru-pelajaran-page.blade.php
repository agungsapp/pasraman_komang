<div class="container-fluid px-4">
		<h1 class="text-capitalize mt-4">Data Guru Pelajaran</h1>

		<div class="row mb-3">
				<div class="col-12">
						<div class="card">
								<div class="card-body">
										<!-- Form for Create/Update -->
										<form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="guru_id" class="form-label">Guru</label>
																<select class="form-control @error('guru_id') is-invalid @enderror" id="guru_id"
																		wire:model.live="guru_id">
																		<option value="">Pilih Guru</option>
																		@foreach ($gurus as $guru)
																				<option value="{{ $guru->id }}">{{ $guru->name }}</option>
																		@endforeach
																</select>
																@error('guru_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="pelajaran_id" class="form-label">Pelajaran</label>
																<select class="form-control @error('pelajaran_id') is-invalid @enderror" id="pelajaran_id"
																		wire:model.live="pelajaran_id">
																		<option value="">Pilih Pelajaran</option>
																		@foreach ($pelajarans as $pelajaran)
																				<option value="{{ $pelajaran->id }}">{{ $pelajaran->nama_pelajaran }}</option>
																		@endforeach
																</select>
																@error('pelajaran_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
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
										<table id="guruPelajaranTable" class="table-striped table">
												<thead>
														<tr>
																<th>No</th>
																<th>Guru</th>
																<th>Pelajaran</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse($guruPelajarans as $index => $item)
																<tr>
																		<td>{{ $guruPelajarans->firstItem() + $index }}</td>
																		<td>{{ $item->guru->name }}</td>
																		<td>{{ $item->pelajaran->nama_pelajaran }}</td>
																		<td>
																				<button wire:click="detail({{ $item->guru_id }})" type="button" class="btn btn-sm btn-primary">
																						Detail
																				</button>
																				<button wire:click="edit({{ $item->guru_id }})" class="btn btn-sm btn-warning">Edit</button>
																				<button wire:click="delete({{ $item->guru_id }})" class="btn btn-sm btn-danger"
																						onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="4" class="text-center">Tidak ada data guru pelajaran</td>
																</tr>
														@endforelse
												</tbody>
										</table>
										<div class="mt-3">
												{{ $guruPelajarans->links() }}
										</div>
								</div>
						</div>
				</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title" id="modalDetailLabel">Detail Guru Pelajaran</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
										@if ($modalDetails && count($modalDetails) > 0)
												<p><strong>Guru:</strong>
														{{ $guruPelajarans->where('guru_id', $guruPelajaranId)->first()->guru->name ?? 'Tidak ada guru' }}</p>
												<h6>Daftar Semua Pelajaran:</h6>
												<table class="table-bordered table-striped table">
														<thead>
																<tr>
																		<th>Pelajaran</th>
																		<th>Tahun Ajaran</th>
																		<th>Status</th>
																</tr>
														</thead>
														<tbody>
																@foreach ($modalDetails as $detail)
																		<tr>
																				<td>{{ $detail['pelajaran']->nama_pelajaran }}</td>
																				<td>{{ $detail['pelajaran']->tahun_ajaran }}</td>
																				<td>{{ $detail['isTaught'] ? 'Diajar' : 'Tidak Diajar' }}</td>
																		</tr>
																@endforeach
														</tbody>
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
						let table = $('#guruPelajaranTable').DataTable({
								"language": {
										"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
								},
								"pageLength": 10,
								"ordering": false
						});

						// Listen for Livewire 'reload-table' event
						Livewire.on('reload-table', () => {
								table.destroy();
								table = $('#guruPelajaranTable').DataTable({
										"language": {
												"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
										},
										"pageLength": 10,
										"ordering": false
								});
						});

						// Listen for Livewire 'open-modal' event
						Livewire.on('open-modal', event => {
								const modal = new bootstrap.Modal(document.getElementById(event.detail.id));
								modal.show();
						});

						// Listen for Livewire 'close-modal' event
						Livewire.on('close-modal', event => {
								const modal = bootstrap.Modal.getInstance(document.getElementById(event.detail.id));
								if (modal) modal.hide();
						});
				});
		</script>
@endpush
