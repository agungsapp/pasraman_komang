<div class="container mt-4">
		<h1 class="mb-4 text-center" data-aos="fade-up" data-aos-delay="100">Manajemen Nilai</h1>

		<!-- Form Tambah/Edit -->
		<div class="card mb-4" data-aos="fade-up" data-aos-delay="200">
				<div class="card-header">
						<h5>{{ $editId ? 'Edit Nilai' : 'Tambah Nilai' }}</h5>
				</div>
				<div class="card-body">
						<form wire:submit.prevent="{{ $editId ? 'update' : 'create' }}">
								<div class="row">
										<div class="col-md-4 mb-3">
												<label for="siswa_id" class="form-label">Siswa</label>
												<select wire:model="siswa_id" class="form-select" id="siswa_id">
														<option value="">Pilih Siswa</option>
														@foreach ($siswas as $siswa)
																<option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
														@endforeach
												</select>
												@error('siswa_id')
														<span class="text-danger">{{ $message }}</span>
												@enderror
										</div>
										<div class="col-md-4 mb-3">
												<label for="pelajaran_id" class="form-label">Pelajaran</label>
												<select wire:model="pelajaran_id" class="form-select" id="pelajaran_id">
														<option value="">Pilih Pelajaran</option>
														@foreach ($pelajarans as $pelajaran)
																<option value="{{ $pelajaran->id }}">{{ $pelajaran->nama_pelajaran }}</option>
														@endforeach
												</select>
												@error('pelajaran_id')
														<span class="text-danger">{{ $message }}</span>
												@enderror
										</div>
										<div class="col-md-4 mb-3">
												<label for="guru_id" class="form-label">Guru</label>
												<select wire:model="guru_id" class="form-select" id="guru_id">
														<option value="">Pilih Guru</option>
														@foreach ($gurus as $guru)
																<option value="{{ $guru->id }}">{{ $guru->name }}</option>
														@endforeach
												</select>
												@error('guru_id')
														<span class="text-danger">{{ $message }}</span>
												@enderror
										</div>
								</div>
								<div class="row">
										<div class="col-md-6 mb-3">
												<label for="nilai" class="form-label">Nilai (0-100)</label>
												<input type="number" wire:model="nilai" class="form-control" id="nilai" min="0" max="100">
												@error('nilai')
														<span class="text-danger">{{ $message }}</span>
												@enderror
										</div>
										<div class="col-md-6 mb-3">
												<label for="keterangan" class="form-label">Keterangan (Opsional)</label>
												<input type="text" wire:model="keterangan" class="form-control" id="keterangan">
												@error('keterangan')
														<span class="text-danger">{{ $message }}</span>
												@enderror
										</div>
								</div>
								<div class="text-end">
										<button type="button" wire:click="resetForm" class="btn btn-secondary btn-sm">Batal</button>
										<button type="submit" class="btn btn-primary btn-sm">{{ $editId ? 'Perbarui' : 'Simpan' }}</button>
								</div>
						</form>
				</div>
		</div>

		<!-- Pencarian -->
		<div class="card mb-4" data-aos="fade-up" data-aos-delay="300">
				<div class="card-body">
						<div class="row">
								<div class="col-md-6 mb-3">
										<input type="text" wire:model.live="search" class="form-control"
												placeholder="Cari siswa, pelajaran, atau guru...">
								</div>
								<div class="col-md-6 mb-3 text-end">
										<select wire:model="perPage" class="form-select d-inline-block w-auto">
												<option value="10">10 per halaman</option>
												<option value="25">25 per halaman</option>
												<option value="50">50 per halaman</option>
										</select>
								</div>
						</div>
				</div>
		</div>

		<!-- Tabel Nilai -->
		<div class="card" data-aos="fade-up" data-aos-delay="400">
				<div class="card-header">
						<h5>Daftar Nilai</h5>
				</div>
				<div class="card-body">
						@if ($nilais->isEmpty())
								<div class="alert alert-info">Belum ada data nilai.</div>
						@else
								<div class="table-responsive">
										<table class="table-striped table">
												<thead>
														<tr>
																<th>Siswa</th>
																<th>Pelajaran</th>
																<th>Guru</th>
																<th>Nilai</th>
																<th>Keterangan</th>
																<th>Aksi</th>
														</tr>
												</thead>
												<tbody>
														@foreach ($nilais as $nilai)
																<tr>
																		<td>{{ $nilai->siswa->nama }}</td>
																		<td>{{ $nilai->pelajaran->nama_pelajaran }}</td>
																		<td>{{ $nilai->guru->name }}</td>
																		<td>{{ $nilai->nilai }}</td>
																		<td>{{ $nilai->keterangan ?? '-' }}</td>
																		<td>
																				<button wire:click="edit({{ $nilai->id }})" class="btn btn-warning btn-sm">Edit</button>
																				<button wire:click="delete({{ $nilai->id }})" class="btn btn-danger btn-sm"
																						onclick="return confirm('Hapus nilai ini?')">Hapus</button>
																		</td>
																</tr>
														@endforeach
												</tbody>
										</table>
								</div>
								<div class="mt-3">
										{{ $nilais->links() }}
								</div>
						@endif
				</div>
		</div>
</div>
@push('css')
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush
