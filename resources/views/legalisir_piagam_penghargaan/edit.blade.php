@extends('main')
@section('title', 'Legalisir Piagam Penghargaan')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Ubah Data Legalisir Piagam Penghargaan</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-2">Data Legalisir Piagam Penghargaan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('legalisir_piagam_penghargaan/edit/' . $legalisir_piagam_penghargaan->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama anda..." value="{{ $legalisir_piagam_penghargaan->nama }}" autofocus/>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="1234567890" value="{{ $legalisir_piagam_penghargaan->nik }}" autofocus/>
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat anda disini.." autofocus>{{ $legalisir_piagam_penghargaan->alamat }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $legalisir_piagam_penghargaan->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="piagam_penghargaan">Piagam Penghargaan Asli</label>
                            <div class="col-sm-10">
                                <input type="file" id="piagam_penghargaan" name="piagam_penghargaan" class="form-control @error('piagam_penghargaan') is-invalid @enderror" value="{{($legalisir_piagam_penghargaan->piagam_penghargaan) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                 @error('piagam_penghargaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($legalisir_piagam_penghargaan->piagam_penghargaan)
                                 <p class="mt-2">File saat ini: <a href="{{asset($legalisir_piagam_penghargaan->piagam_penghargaan) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="fotokopi_piagam_penghargaan">Foto KTP</label>
                            <div class="col-sm-10">
                                <input type="file" id="fotokopi_piagam_penghargaan" name="fotokopi_piagam_penghargaan" class="form-control @error('fotokopi_piagam_penghargaan') is-invalid @enderror" value="{{ $legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('fotokopi_piagam_penghargaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan)
                                 <p class="mt-2">File saat ini: <a href="{{asset($legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Not Started" {{ $legalisir_piagam_penghargaan->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                                        <option value="In Progress" {{ $legalisir_piagam_penghargaan->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $legalisir_piagam_penghargaan->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('legalisir_piagam_penghargaan') }}" class="btn btn-outline-secondary">Kembali</a>

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