@extends('main')
@section('title', 'DAPODIK')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Ubah Data DAPODIK</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-2">Data DAPODIK</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('pelayanan_dapodik/edit/' . $pelayanan_dapodik->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama anda..." value="{{ $pelayanan_dapodik->nama }}" autofocus/>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="1234567890" value="{{ $pelayanan_dapodik->nik }}" autofocus/>
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat anda disini.." autofocus>{{ $pelayanan_dapodik->alamat }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $pelayanan_dapodik->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_pertanggungjawaban">Surat Pertanggungjawaban dari aplikasi DAPODIK</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_pertanggungjawaban" name="surat_pertanggungjawaban" class="form-control @error('surat_pertanggungjawaban') is-invalid @enderror" value="{{($pelayanan_dapodik->surat_pertanggungjawaban) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                 @error('surat_pertanggungjawaban')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($pelayanan_dapodik->surat_pertanggungjawaban)
                                 <p class="mt-2">File saat ini: <a href="{{asset($pelayanan_dapodik->surat_pertanggungjawaban) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="gtk_persemester">File GTK persemester</label>
                            <div class="col-sm-10">
                                <input type="file" id="gtk_persemester" name="gtk_persemester" class="form-control @error('gtk_persemester') is-invalid @enderror" value="{{ $pelayanan_dapodik->gtk_persemester }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('gtk_persemester')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($pelayanan_dapodik->gtk_persemester)
                                 <p class="mt-2">File saat ini: <a href="{{asset($pelayanan_dapodik->gtk_persemester) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="usul_sktp">Format usulan pengajuan SKTP dari Kepala Sekolah</label>
                            <div class="col-sm-10">
                                <input type="file" id="usul_sktp" name="usul_sktp" class="form-control @error('usul_sktp') is-invalid @enderror" value="{{ $pelayanan_dapodik->usul_sktp }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('usul_sktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($pelayanan_dapodik->usul_sktp)
                                 <p class="mt-2">File saat ini: <a href="{{asset($pelayanan_dapodik->usul_sktp) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Not Started" {{ $pelayanan_dapodik->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                                        <option value="In Progress" {{ $pelayanan_dapodik->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $pelayanan_dapodik->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('pelayanan_dapodik') }}" class="btn btn-outline-secondary">Kembali</a>

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