<div class="container-fluid px-4">
		<h1 class="mt-4">Manajemen Jadwal</h1>

		<!-- Form Filter -->
		<div class="card mb-3">
				<div class="card-body">
						<div class="row">
								<div class="col-md-6 mb-3">
										<label for="filter_siswa_id" class="form-label">Filter Siswa</label>
										<select class="form-control" wire:model.live="filter_siswa_id">
												<option value="">Semua Siswa</option>
												@foreach ($siswas as $siswa)
														<option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
												@endforeach
										</select>
								</div>
								<div class="col-md-6 mb-3">
										<label for="filter_kelas_id" class="form-label">Filter Kelas</label>
										<select class="form-control" wire:model.live="filter_kelas_id">
												<option value="">Semua Kelas</option>
												@foreach ($kelas as $kls)
														<option value="{{ $kls->id }}">{{ $kls->nama }}</option>
												@endforeach
										</select>
								</div>
						</div>
				</div>
		</div>

		<!-- Form CRUD -->
		<div class="card mb-3">
				<div class="card-body">
						<form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
								<div class="row">
										<div class="col-md-4 mb-3">
												<label for="pelajaran_id" class="form-label">Pelajaran</label>
												<select class="form-control @error('pelajaran_id') is-invalid @enderror" wire:model="pelajaran_id">
														<option value="">Pilih Pelajaran</option>
														@foreach ($pelajarans as $pelajaran)
																<option value="{{ $pelajaran->id }}">{{ $pelajaran->nama_pelajaran }}</option>
														@endforeach
												</select>
												@error('pelajaran_id')
														<div class="invalid-feedback">{{ $message }}</div>
												@enderror
										</div>
										<div class="col-md-4 mb-3">
												<label for="hari" class="form-label">Hari</label>
												<select class="form-control @error('hari') is-invalid @enderror" wire:model="hari">
														<option value="">Pilih Hari</option>
														@foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
																<option value="{{ $hari }}">{{ $hari }}</option>
														@endforeach
												</select>
												@error('hari')
														<div class="invalid-feedback">{{ $message }}</div>
												@enderror
										</div>
										<div class="col-md-4 mb-3">
												<label for="jam_mulai" class="form-label">Jam Mulai</label>
												<input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" wire:model="jam_mulai">
												@error('jam_mulai')
														<div class="invalid-feedback">{{ $message }}</div>
												@enderror
										</div>
										<div class="col-md-4 mb-3">
												<label for="jam_selesai" class="form-label">Jam Selesai</label>
												<input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
														wire:model="jam_selesai">
												@error('jam_selesai')
														<div class="invalid-feedback">{{ $message }}</div>
												@enderror
										</div>
										<div class="col-md-4 mb-3">
												<label for="kelas_id" class="form-label">Kelas</label>
												<select class="form-control @error('kelas_id') is-invalid @enderror" wire:model="kelas_id">
														<option value="">Pilih Kelas</option>
														@foreach ($kelas as $kls)
																<option value="{{ $kls->id }}">{{ $kls->nama }}</option>
														@endforeach
												</select>
												@error('kelas_id')
														<div class="invalid-feedback">{{ $message }}</div>
												@enderror
										</div>
										<div class="col-md-4 mb-3">
												<label for="guru_id" class="form-label">Guru</label>
												<select class="form-control @error('guru_id') is-invalid @enderror" wire:model="guru_id">
														<option value="">Pilih Guru</option>
														@foreach ($gurus as $guru)
																<option value="{{ $guru->id }}">{{ $guru->name }}</option>
														@endforeach
												</select>
												@error('guru_id')
														<div class="invalid-feedback">{{ $message }}</div>
												@enderror
										</div>
								</div>
								<div class="d-flex gap-2">
										<button type="submit" class="btn btn-primary">{{ $editMode ? 'Update' : 'Simpan' }}</button>
										@if ($editMode)
												<button type="button" wire:click="cancelEdit" class="btn btn-secondary">Batal</button>
										@endif
								</div>
						</form>
				</div>
		</div>

		<!-- Tabel Jadwal -->
		<div class="card">
				<div class="card-body">
						<table id="jadwalTable" class="table-striped table">
								<thead>
										<tr>
												<th>Pelajaran</th>
												<th>Hari</th>
												<th>Jam Mulai</th>
												<th>Jam Selesai</th>
												<th>Kelas</th>
												<th>Guru</th>
												<th>Aksi</th>
										</tr>
								</thead>
								<tbody>
										@forelse ($jadwals as $jadwal)
												<tr>
														<td>{{ $jadwal->pelajaran->nama_pelajaran ?? 'N/A' }}</td>
														<td>{{ $jadwal->hari }}</td>
														<td>{{ $jadwal->jam_mulai }}</td>
														<td>{{ $jadwal->jam_selesai }}</td>
														<td>{{ $jadwal->kelas->nama ?? 'N/A' }}</td>
														<td>{{ $jadwal->guru->name ?? 'N/A' }}</td>
														<td>
																<button wire:click="edit({{ $jadwal->id }})" class="btn btn-sm btn-warning">Edit</button>
																<button wire:click="delete({{ $jadwal->id }})" class="btn btn-sm btn-danger">Hapus</button>
														</td>
												</tr>
										@empty
												<tr>
														<td colspan="7" class="text-center">Tidak ada jadwal.</td>
												</tr>
										@endforelse
								</tbody>
						</table>
				</div>
		</div>
</div>

@push('css')
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('js')
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
				document.addEventListener('livewire:initialized', () => {
						let table = $('#jadwalTable').DataTable({
								"language": {
										"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
								},
								"pageLength": 10,
						});

						window.Livewire.on('reload-table', () => {
								table.destroy();
								table = $('#jadwalTable').DataTable({
										"language": {
												"url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
										},
										"pageLength": 10,
								});
						});

						window.Livewire.on('swal:alert', event => {
								Swal.fire({
										title: event.detail.title,
										text: event.detail.text,
										icon: event.detail.icon,
										confirmButtonText: 'OK'
								});
						});
				});
		</script>
@endpush
