@extends('main')
@section('title', 'Pengelolaan BOS')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Ubah Data Pengelolaan BOS</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-2">Data Pengelolaan BOS</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('pengelolaan_dana_bos/edit/' . $pengelolaan_dana_bos->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama anda..." value="{{ $pengelolaan_dana_bos->nama }}" autofocus/>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="1234567890" value="{{ $pengelolaan_dana_bos->nik }}" autofocus/>
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat anda disini.." autofocus>{{ $pengelolaan_dana_bos->alamat }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $pengelolaan_dana_bos->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="dokumen_pertanggungjawaban_keuangan">Dokumen Pertanggungjawaban Keuangan</label>
                            <div class="col-sm-10">
                                <input type="file" id="dokumen_pertanggungjawaban_keuangan" name="dokumen_pertanggungjawaban_keuangan" class="form-control @error('dokumen_pertanggungjawaban_keuangan') is-invalid @enderror" value="{{($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                 @error('dokumen_pertanggungjawaban_keuangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan)
                                 <p class="mt-2">File saat ini: <a href="{{asset($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_pengantar_kepala_sekolah">Surat Pengantar dari Kepala Sekolah</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_pengantar_kepala_sekolah" name="surat_pengantar_kepala_sekolah" class="form-control @error('surat_pengantar_kepala_sekolah') is-invalid @enderror" value="{{ $pengelolaan_dana_bos->surat_pengantar_kepala_sekolah }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('surat_pengantar_kepala_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah)
                                 <p class="mt-2">File saat ini: <a href="{{asset($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="usul_sktp">Format usulan pengajuan SKTP dari Kepala Sekolah</label>
                            <div class="col-sm-10">
                                <input type="file" id="usul_sktp" name="usul_sktp" class="form-control @error('usul_sktp') is-invalid @enderror" value="{{ $pengelolaan_dana_bos->usul_sktp }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('usul_sktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($pengelolaan_dana_bos->usul_sktp)
                                 <p class="mt-2">File saat ini: <a href="{{asset($pengelolaan_dana_bos->usul_sktp) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('pengelolaan_dana_bos') }}" class="btn btn-outline-secondary">Kembali</a>

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