@extends('main')
@section('title', 'Detail Surat Pengganti Ijazah/STTB Hilang')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Surat Pengganti Ijazah/STTB Hilang</h4>

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
                            {{': ' . $surat_pengganti_ijazah_sttb_hilang->nama }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>NIK<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $surat_pengganti_ijazah_sttb_hilang->nik }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $surat_pengganti_ijazah_sttb_hilang->alamat }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Handphone/WhatsApp<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $surat_pengganti_ijazah_sttb_hilang->no_hp }}
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Berkas Persyaratan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Fotokopi Ijazah/STTB yang hilang (jika masih ada)</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang)
                            <span>:</span>
                            <a href="{{ asset($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang) }}" target="_blank">Lihat File</a>
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
                            @if($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran)
                            <span>:</span>
                            <a href="{{ asset($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Keterangan Tanda Lapor Kehilangan dari Kepolisian</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan)
                            <span>:</span>
                            <a href="{{ asset($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Pernyataan Tanggung Jawab Mutlak dari Pemilik Ijazah/STTB</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab)
                            <span>:</span>
                            <a href="{{ asset($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Keterangan 2 (dua) Orang Saksi</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi)
                            <span>:</span>
                            <a href="{{ asset($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Berkas dokumen sesuai kewenangan</label>
                        </div>
                        <div class="col-md-8">
                            @if($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan)
                            <span>:</span>
                            <a href="{{ asset($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan) }}" target="_blank">Lihat File</a>
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
                            @if($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik)
                            <span>:</span>
                            <a href="{{ asset($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('surat_pengganti_ijazah_sttb_hilang') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection