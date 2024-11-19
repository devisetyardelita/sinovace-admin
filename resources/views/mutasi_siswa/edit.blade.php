@extends('main')
@section('title', 'Mutasi Siswa')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Ubah Data Mutasi Siswa</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-2">Data Mutasi Siswa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('mutasi_siswa/edit/' . $mutasi_siswa->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama anda..." value="{{ $mutasi_siswa->nama }}" autofocus/>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="1234567890" value="{{ $mutasi_siswa->nik }}" autofocus/>
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat anda disini.." autofocus>{{ $mutasi_siswa->alamat }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $mutasi_siswa->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_rekomendasi_sekolah_asal">Surat Rekomendasi Sekolah Asal</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_rekomendasi_sekolah_asal" name="surat_rekomendasi_sekolah_asal" class="form-control @error('surat_rekomendasi_sekolah_asal') is-invalid @enderror" value="{{($mutasi_siswa->surat_rekomendasi_sekolah_asal) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                 @error('surat_rekomendasi_sekolah_asal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($mutasi_siswa->surat_rekomendasi_sekolah_asal)
                                 <p class="mt-2">File saat ini: <a href="{{asset($mutasi_siswa->surat_rekomendasi_sekolah_asal) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_rekomendasi_sekolah_tujuan">Surat Rekomendasi Sekolah Tujuan</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_rekomendasi_sekolah_tujuan" name="surat_rekomendasi_sekolah_tujuan" class="form-control @error('surat_rekomendasi_sekolah_tujuan') is-invalid @enderror" value="{{ $mutasi_siswa->surat_rekomendasi_sekolah_tujuan }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('surat_rekomendasi_sekolah_tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($mutasi_siswa->surat_rekomendasi_sekolah_tujuan)
                                 <p class="mt-2">File saat ini: <a href="{{asset($mutasi_siswa->surat_rekomendasi_sekolah_tujuan) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Not Started" {{ $mutasi_siswa->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                                        <option value="In Progress" {{ $mutasi_siswa->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $mutasi_siswa->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('mutasi_siswa') }}" class="btn btn-outline-secondary">Kembali</a>

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