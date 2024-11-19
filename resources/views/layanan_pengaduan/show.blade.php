@extends('main')
@section('title', 'Detail Layanan Pengaduan')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Layanan Pengaduan</h4>

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
                            {{': ' . $layanan_pengaduan->nama }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>NIK<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $layanan_pengaduan->nik }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $layanan_pengaduan->alamat }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Handphone/WhatsApp<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $layanan_pengaduan->no_hp }}
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Berkas Persyaratan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Permohonan Pengajuan</label>
                        </div>
                        <div class="col-md-8">
                            @if($layanan_pengaduan->file_surat_permohonan_pengajuan)
                            <span>:</span>
                            <a href="{{ asset($layanan_pengaduan->file_surat_permohonan_pengajuan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Foto KTP</label>
                        </div>
                        <div class="col-md-8">
                            @if($layanan_pengaduan->foto_ktp)
                            <span>:</span>
                            <a href="{{ asset($layanan_pengaduan->foto_ktp) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Foto Bukti Pengaduan</label>
                        </div>
                        <div class="col-md-8">
                            @if($layanan_pengaduan->foto_bukti_pengaduan)
                            <span>:</span>
                            <a href="{{ asset($layanan_pengaduan->foto_bukti_pengaduan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('layanan_pengaduan') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection