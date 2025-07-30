<div class="container-fluid px-4">
		<h1 class="text-capitalize mt-4">Data Pelajaran</h1>

		<div class="row mb-3">
				<div class="col-12">
						<div class="card">
								<div class="card-body">
										<!-- Form for Create/Update -->
										<form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="nama_pelajaran" class="form-label">Nama Pelajaran</label>
																<input type="text" class="form-control @error('nama_pelajaran') is-invalid @enderror"
																		id="nama_pelajaran" wire:model="nama_pelajaran" placeholder="Masukkan nama pelajaran">
																@error('nama_pelajaran')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
																<input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran"
																		wire:model="tahun_ajaran" placeholder="Masukkan tahun ajaran (contoh: 2024/2025)">
																@error('tahun_ajaran')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-md-6 mb-3">
																<div class="form-check">
																		<input class="form-check-input" type="checkbox" id="is_active" wire:model="is_active">
																		<label class="form-check-label" for="is_active">Aktif</label>
																</div>
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
										<table id="pelajaranTable" class="table-striped table">
												<thead>
														<tr>
																<th>No</th>
																<th>Nama Pelajaran</th>
																<th>Tahun Ajaran</th>
																<th>Status</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse($pelajarans as $index => $item)
																<tr>
																		<td>{{ $index + 1 }}</td>
																		<td>{{ $item->nama_pelajaran }}</td>
																		<td>{{ $item->tahun_ajaran }}</td>
																		<td>{{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
																		<td>
																				<button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
																				<button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
																						onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="5" class="text-center">Tidak ada data pelajaran</td>
																</tr>
														@endforelse
												</tbody>
										</table>
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
						let table = $('#pelajaranTable').DataTable({
								"language": {
										"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
								},
								"pageLength": 10,
								"ordering": false
						});

						// Listen for Livewire 'reload-table' event
						Livewire.on('reload-table', () => {
								// alert('dipicu')
								table.destroy();
								table = $('#pelajaranTable').DataTable({
										"language": {
												"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
										},
										"pageLength": 10,
										"ordering": false
								});
						});


				});
		</script>
@endpush
