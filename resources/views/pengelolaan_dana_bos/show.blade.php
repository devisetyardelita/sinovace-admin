@extends('main')
@section('title', 'Detail Pengelolaan BOS')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Pengelolaan BOS</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Diri</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengelolaan_dana_bos->nama }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>NIK<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengelolaan_dana_bos->nik }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengelolaan_dana_bos->alamat }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Handphone/WhatsApp<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengelolaan_dana_bos->no_hp }}
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Berkas Persyaratan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Dokumen Pertanggungjawaban Keuangan</label>
                        </div>
                        <div class="col-md-8">
                            @if($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan)
                            <span>:</span>
                            <a href="{{ asset($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Pengantar dari Kepala Sekolah</label>
                        </div>
                        <div class="col-md-8">
                            @if($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah)
                            <span>:</span>
                            <a href="{{ asset($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('pengelolaan_dana_bos') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection