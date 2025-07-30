<div class="container-fluid px-4">
		<h1 class="text-capitalize mt-4">Data Pelajaran Siswa</h1>

		<div class="row mb-3">
				<div class="col-12">
						<div class="card">
								<div class="card-body">
										<!-- Form for Create/Update -->
										<form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="siswa_id" class="form-label">Nama Siswa</label>
																<select class="form-control @error('siswa_id') is-invalid @enderror" id="siswa_id"
																		wire:model="siswa_id">
																		<option value="">Pilih Siswa</option>
																		@foreach ($siswas as $siswa)
																				<option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
																		@endforeach
																</select>
																@error('siswa_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="pelajaran_id" class="form-label">Nama Pelajaran</label>
																<select class="form-control @error('pelajaran_id') is-invalid @enderror" id="pelajaran_id"
																		wire:model="pelajaran_id">
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
										<table id="pelajaranSiswaTable" class="table-striped table">
												<thead>
														<tr>
																<th>No</th>
																<th>Nama Siswa</th>
																<th>Nama Pelajaran</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse($pelajaranSiswas as $index => $item)
																<tr>
																		<td>{{ $loop->iteration }}</td>
																		<td>{{ $item->siswa->nama }}</td>
																		<td>{{ $item->pelajaran->nama }}</td>
																		<td>
																				<button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
																				<button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
																						onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="4" class="text-center">Tidak ada data pelajaran siswa</td>
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
						let table = $('#pelajaranSiswaTable').DataTable({
								"language": {
										"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
								},
								"pageLength": 10,
						});

						// Listen for Livewire's dispatched event
						window.addEventListener('reload-table', function() {
								table.destroy();
								table = $('#pelajaranSiswaTable').DataTable({
										"language": {
												"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
										},
										"pageLength": 10,
								});
						});
				});
		</script>
@endpush
