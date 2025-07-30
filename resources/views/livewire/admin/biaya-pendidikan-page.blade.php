<div class="container-fluid px-4">
		<h1 class="text-capitalize mt-4">Data Biaya Pendidikan</h1>

		<div class="row mb-3">
				<div class="col-12">
						<div class="card">
								<div class="card-body">
										<!-- Form for Create/Update -->
										<form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="jenjang_id" class="form-label">Jenjang</label>
																<select class="form-control @error('jenjang_id') is-invalid @enderror" id="jenjang_id"
																		wire:model="jenjang_id">
																		<option value="">Pilih Jenjang</option>
																		@foreach ($jenjangs as $jenjang)
																				<option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
																		@endforeach
																</select>
																@error('jenjang_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="komponen_biaya_id" class="form-label">Komponen Biaya</label>
																<select class="form-control @error('komponen_biaya_id') is-invalid @enderror" id="komponen_biaya_id"
																		wire:model="komponen_biaya_id">
																		<option value="">Pilih Komponen Biaya</option>
																		@foreach ($komponenBiayas as $komponen)
																				<option value="{{ $komponen->id }}">{{ $komponen->nama }}</option>
																		@endforeach
																</select>
																@error('komponen_biaya_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="nominal" class="form-label">Nominal (Rp)</label>
																<input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal"
																		wire:model="nominal" placeholder="Masukkan nominal biaya" step="0.01">
																@error('nominal')
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
										<table id="biayaTable" class="table-striped table">
												<thead>
														<tr>
																<th>No</th>
																<th>Jenjang</th>
																<th>Komponen Biaya</th>
																<th>Nominal (Rp)</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse($biayas as $index => $item)
																<tr>
																		<td>{{ $loop->iteration }}</td>
																		<td>{{ $item->jenjang ? $item->jenjang->nama : '-' }}</td>
																		<td>{{ $item->komponenBiaya ? $item->komponenBiaya->nama : '-' }}</td>
																		<td>{{ number_format($item->nominal, 2, ',', '.') }}</td>
																		<td>
																				<button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
																				<button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
																						onclick="return confirm('Yakin ingin menghapus?')"
																						{{ $item->pembayaranDetails()->count() == 0 ? '' : 'disabled' }}>Hapus</button>
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="5" class="text-center">Tidak ada data biaya pendidikan</td>
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
						let table = $('#biayaTable').DataTable({
								"language": {
										"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
								},
								"pageLength": 10,
								"responsive": true,
						});

						window.addEventListener('reload-table', function() {
								table.destroy();
								table = $('#biayaTable').DataTable({
										"language": {
												"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
										},
										"pageLength": 10,
										"responsive": true,
								});
						});
				});
		</script>
@endpush
