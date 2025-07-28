<div class="container-fluid px-4">
		<h1 class="text-capitalize mt-4">Data Kelas</h1>

		<div class="row mb-3">
				<div class="col-12">
						<div class="card">
								<div class="card-body">
										<!-- Form for Create/Update -->
										<form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
												<div class="mb-3">
														<label for="nama" class="form-label">Nama Kelas</label>
														<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
																wire:model="nama" placeholder="Masukkan nama kelas">
														@error('nama')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
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
										<table class="table-striped table">
												<thead>
														<tr>
																<th>No</th>
																<th>Nama Kelas</th>
																<th>Jumlah Siswa</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse($kelas as $index => $item)
																<tr>
																		<td>{{ $index + 1 }}</td>
																		<td>{{ $item->nama }}</td>
																		<td>{{ $item->siswas()->count() }}</td>
																		<td>
																				<button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
																				<button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
																						onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="4" class="text-center">Tidak ada data kelas</td>
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
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
