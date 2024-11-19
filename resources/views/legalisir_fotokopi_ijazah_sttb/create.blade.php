@extends('main')
@section('title', 'Legalisir Fotokopi Ijazah/STTB')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Tambah Data Legalisir Fotokopi Ijazah/STTB</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Data Legalisir Fotokopi Ijazah/STTB</h5>
                </div>
                <div class="card-body">
                <form action="{{ url('legalisir_fotokopi_ijazah_sttb/create') }}" method="POST" enctype="multipart/form-data">
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
                        <label class="col-sm-2 col-form-label" for="ijazah_sttb_asli">Ijazah/STTB Asli</label>
                        <div class="col-sm-10">
                            <input type="file" id="ijazah_sttb_asli" name="ijazah_sttb_asli" class="form-control @error('ijazah_sttb_asli') is-invalid @enderror"  />
                            <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                             @error('ijazah_sttb_asli')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="fotokopi_ijazah_sttb">Fotokopi Ijazah/STTB</label>
                        <div class="col-sm-10">
                            <input type="file" id="fotokopi_ijazah_sttb" name="fotokopi_ijazah_sttb" class="form-control @error('fotokopi_ijazah_sttb') is-invalid @enderror" />
                            <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                              @error('fotokopi_ijazah_sttb')
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
                        <a href="{{ url('legalisir_fotokopi_ijazah_sttb') }}" class="btn btn-outline-secondary">Kembali</a>
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