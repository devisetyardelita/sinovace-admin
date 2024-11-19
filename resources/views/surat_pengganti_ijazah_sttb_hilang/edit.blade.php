@extends('main')
@section('title', 'Surat Pengganti Ijazah/STTB Hilang')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Ubah Data Surat Pengganti Ijazah/STTB Hilang</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-2">Data Surat Pengganti Ijazah/STTB Hilang</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('surat_pengganti_ijazah_sttb_hilang/edit/' . $surat_pengganti_ijazah_sttb_hilang->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama anda..." value="{{ $surat_pengganti_ijazah_sttb_hilang->nama }}" autofocus/>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="1234567890" value="{{ $surat_pengganti_ijazah_sttb_hilang->nik }}" autofocus/>
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat anda disini.." autofocus>{{ $surat_pengganti_ijazah_sttb_hilang->alamat }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $surat_pengganti_ijazah_sttb_hilang->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="fotokopi_ijazah_sttb_hilang">Fotokopi Ijazah/STTB yang hilang (jika masih ada)</label>
                            <div class="col-sm-10">
                                <input type="file" id="fotokopi_ijazah_sttb_hilang" name="fotokopi_ijazah_sttb_hilang" class="form-control @error('fotokopi_ijazah_sttb_hilang') is-invalid @enderror" value="{{($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                 @error('fotokopi_ijazah_sttb_hilang')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang)
                                 <p class="mt-2">File saat ini: <a href="{{asset($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="fotokopi_akta_kelahiran">Fotokopi akta kelahiran</label>
                            <div class="col-sm-10">
                                <input type="file" id="fotokopi_akta_kelahiran" name="fotokopi_akta_kelahiran" class="form-control @error('fotokopi_akta_kelahiran') is-invalid @enderror" value="{{ $surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('fotokopi_akta_kelahiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran)
                                 <p class="mt-2">File saat ini: <a href="{{asset($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_keterangan_kehilangan">Surat Keterangan Tanda Lapor Kehilangan dari Kepolisian</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_keterangan_kehilangan" name="surat_keterangan_kehilangan" class="form-control @error('surat_keterangan_kehilangan') is-invalid @enderror" value="{{ $surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('surat_keterangan_kehilangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan)
                                 <p class="mt-2">File saat ini: <a href="{{asset($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_pernyataan_tanggungjawab">Surat Pernyataan Tanggung Jawab Mutlak dari Pemilik Ijazah/STTB</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_pernyataan_tanggungjawab" name="surat_pernyataan_tanggungjawab" class="form-control @error('surat_pernyataan_tanggungjawab') is-invalid @enderror" value="{{ $surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('surat_pernyataan_tanggungjawab')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab)
                                 <p class="mt-2">File saat ini: <a href="{{asset($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_keterangan_saksi">Surat Keterangan 2 (dua) Orang Saksi</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_keterangan_saksi" name="surat_keterangan_saksi" class="form-control @error('surat_keterangan_saksi') is-invalid @enderror" value="{{ $surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('surat_keterangan_saksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi)
                                 <p class="mt-2">File saat ini: <a href="{{asset($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="dokumen_kewenangan">Berkas dokumen sesuai kewenangan</label>
                            <div class="col-sm-10">
                                <input type="file" id="dokumen_kewenangan" name="dokumen_kewenangan" class="form-control @error('dokumen_kewenangan') is-invalid @enderror" value="{{ $surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('dokumen_kewenangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan)
                                 <p class="mt-2">File saat ini: <a href="{{asset($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="lembar_cek_nisn_dapodik">Lembar cek NISN pada aplikasi Dapodik</label>
                            <div class="col-sm-10">
                                <input type="file" id="lembar_cek_nisn_dapodik" name="lembar_cek_nisn_dapodik" class="form-control @error('lembar_cek_nisn_dapodik') is-invalid @enderror" value="{{ $surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik }}"/>
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png.</p></small>
                                  @error('lembar_cek_nisn_dapodik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                                 @if ($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik)
                                 <p class="mt-2">File saat ini: <a href="{{asset($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik) }}" target="_blank">Lihat File</a></p>
                                 @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Not Started" {{ $surat_pengganti_ijazah_sttb_hilang->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                                        <option value="In Progress" {{ $surat_pengganti_ijazah_sttb_hilang->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $surat_pengganti_ijazah_sttb_hilang->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('surat_pengganti_ijazah_sttb_hilang') }}" class="btn btn-outline-secondary">Kembali</a>

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