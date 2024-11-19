@extends('main')
@section('title', 'Detail Surat Keterangan Ralat Ijazah/STTB')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Surat Keterangan Ralat Ijazah/STTB</h4>

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
                            {{': ' . $surat_keterangan_ralat_ijazah_sttb->nama }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>NIK<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $surat_keterangan_ralat_ijazah_sttb->nik }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $surat_keterangan_ralat_ijazah_sttb->alamat }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Handphone/WhatsApp<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $surat_keterangan_ralat_ijazah_sttb->no_hp }}
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Berkas Persyaratan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Fotokopi Ijazah/STTB yang akan disesuaikan/ralat</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb)
                            <span>:</span>
                            <a href="{{ asset($surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Fotokopi akta kelahiran</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran)
                            <span>:</span>
                            <a href="{{ asset($surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Berkas yang akan diralat sesuai kewenangan</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan)
                            <span>:</span>
                            <a href="{{ asset($surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Lembar cek NISN pada aplikasi Dapodik</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik)
                            <span>:</span>
                            <a href="{{ asset($surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('surat_keterangan_ralat_ijazah_sttb') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection