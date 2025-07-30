<div class="container-fluid px-4">
		<h1 class="text-capitalize mt-4">Data Siswa</h1>

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
																<label for="kelas_id" class="form-label">Kelas</label>
																<select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id"
																		wire:model="kelas_id">
																		<option value="">Pilih Kelas</option>
																		@foreach ($kelas as $k)
																				<option value="{{ $k->id }}">{{ $k->nama }}</option>
																		@endforeach
																</select>
																@error('kelas_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="nama" class="form-label">Nama Siswa</label>
																<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
																		wire:model="nama" placeholder="Masukkan nama siswa">
																@error('nama')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="nisn" class="form-label">NISN</label>
																<input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
																		wire:model="nisn" placeholder="Masukkan NISN">
																@error('nisn')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="email" class="form-label">Email</label>
																<input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
																		wire:model="email" placeholder="Masukkan email">
																@error('email')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="no_orang_tua" class="form-label">No. Orang Tua</label>
																<input type="text" class="form-control @error('no_orang_tua') is-invalid @enderror" id="no_orang_tua"
																		wire:model="no_orang_tua" placeholder="Masukkan nomor orang tua">
																@error('no_orang_tua')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="nama_orang_tua" class="form-label">Nama Orang Tua</label>
																<input type="text" class="form-control @error('nama_orang_tua') is-invalid @enderror"
																		id="nama_orang_tua" wire:model="nama_orang_tua" placeholder="Masukkan nama orang tua">
																@error('nama_orang_tua')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
																<input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
																		id="tanggal_lahir" wire:model="tanggal_lahir">
																@error('tanggal_lahir')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="tempat_lahir" class="form-label">Tempat Lahir</label>
																<input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
																		wire:model="tempat_lahir" placeholder="Masukkan tempat lahir">
																@error('tempat_lahir')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="alamat" class="form-label">Alamat</label>
																<textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" wire:model="alamat"
																  placeholder="Masukkan alamat"></textarea>
																@error('alamat')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="password" class="form-label">Password</label>
																<input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
																		wire:model="password" placeholder="Masukkan password">
																@error('password')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
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
										<table id="siswaTable" class="table-striped table">
												<thead>
														<tr>
																<th>No</th>
																<th>Nama</th>
																<th>NISN</th>
																<th>Jenjang</th>
																<th>Kelas</th>
																<th>Email</th>
																<th>No. Orang Tua</th>
																<th>Nama Orang Tua</th>
																<th>Tanggal Lahir</th>
																<th>Tempat Lahir</th>
																<th>Status</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse($siswas as $index => $item)
																<tr>
																		<td>{{ $loop->iteration }}</td>
																		<td>{{ $item->nama }}</td>
																		<td>{{ $item->nisn ?? '-' }}</td>
																		<td>{{ $item->jenjang ? $item->jenjang->nama : '-' }}</td>
																		<td>{{ $item->kelas ? $item->kelas->nama : '-' }}</td>
																		<td>{{ $item->email }}</td>
																		<td>{{ $item->no_orang_tua }}</td>
																		<td>{{ $item->nama_orang_tua }}</td>
																		<td>{{ $item->tanggal_lahir->format('d/m/Y') }}</td>
																		<td>{{ $item->tempat_lahir }}</td>
																		<td>{{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
																		<td>
																				<button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
																				<button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
																						onclick="return confirm('Yakin ingin menghapus?')"
																						{{ $item->nilais()->count() == 0 ? '' : 'disabled' }}>Hapus</button>
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="12" class="text-center">Tidak ada data siswa</td>
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
						let table = $('#siswaTable').DataTable({
								"language": {
										"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
								},
								"pageLength": 10,
						});

						// Listen for Livewire's dispatched event
						window.addEventListener('reload-table', function() {
								table.destroy();
								table = $('#siswaTable').DataTable({
										"language": {
												"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
										},
										"pageLength": 10,
								});
						});
				});
		</script>
@endpush
