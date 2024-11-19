@extends('main')
@section('title', 'Layanan Pengaduan')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Tambah Data Layanan Pengaduan</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Data Layanan Pengaduan</h5>
                </div>
                <div class="card-body">
                <form action="{{ url('layanan_pengaduan/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama anda..." value="{{ old('nama') }}" autofocus/>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="1234567890" value="{{ old('nik') }}" autofocus/>
                            @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat anda disini.." autofocus>{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                    <div class="col-sm-10">
                        <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ old('no_hp') }}" autofocus/>
                        @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                    </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="file_surat_permohonan_pengajuan">File Surat Permohonan Pengajuan</label>
                        <div class="col-sm-10">
                            <input type="file" id="file_surat_permohonan_pengajuan" name="file_surat_permohonan_pengajuan" class="form-control @error('file_surat_permohonan_pengajuan') is-invalid @enderror"  />
                            <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                             @error('file_surat_permohonan_pengajuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="foto_ktp">Foto KTP</label>
                        <div class="col-sm-10">
                            <input type="file" id="foto_ktp" name="foto_ktp" class="form-control @error('foto_ktp') is-invalid @enderror" />
                            <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                              @error('foto_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="foto_bukti_pengaduan">Foto Bukti Pengaduan</label>
                        <div class="col-sm-10">
                            <input type="file" id="foto_bukti_pengaduan" name="foto_bukti_pengaduan" class="form-control @error('foto_bukti_pengaduan') is-invalid @enderror" />
                            <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                              @error('foto_bukti_pengaduan')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status">Status</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="status" id="status" class="form-select">
                                    <option value="Not Started">Not Started</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ url('layanan_pengaduan') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection