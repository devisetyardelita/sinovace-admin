@extends('main')
@section('title', 'Detail Legalisir Fotokopi Ijazah/STTB')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Legalisir Fotokopi Ijazah/STTB</h4>

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
                            {{': ' . $legalisir_fotokopi_ijazah_sttb->nama }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>NIK<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $legalisir_fotokopi_ijazah_sttb->nik }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $legalisir_fotokopi_ijazah_sttb->alamat }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Handphone/WhatsApp<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $legalisir_fotokopi_ijazah_sttb->no_hp }}
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Berkas Persyaratan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Ijazah/STTB Asli</label>
                        </div>
                        <div class="col-md-8">
                            @if($legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli)
                            <span>:</span>
                            <a href="{{ asset($legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Fotokopi Ijazah/STTB</label>
                        </div>
                        <div class="col-md-8">
                            @if($legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb)
                            <span>:</span>
                            <a href="{{ asset($legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('legalisir_fotokopi_ijazah_sttb') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection