<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SuratPenggantiIjazahSTTBHilang;
use App\Exports\SuratPenggantiIjazahSTTBHilangExport;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPenggantiIjazahSTTBHilangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search2;
        if ($search) {
            $surat_pengganti_ijazah_sttb_hilang = SuratPenggantiIjazahSTTBHilang::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $surat_pengganti_ijazah_sttb_hilang = SuratPenggantiIjazahSTTBHilang::paginate(10);
        }
        return view('surat_pengganti_ijazah_sttb_hilang.index', compact('surat_pengganti_ijazah_sttb_hilang', 'search'));
    }


    public function create()
    {
        return view('surat_pengganti_ijazah_sttb_hilang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:surat_pengganti_ijazah_sttb_hilang,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'fotokopi_ijazah_sttb_hilang' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'surat_keterangan_kehilangan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_pernyataan_tanggungjawab' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'surat_keterangan_saksi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_kewenangan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'lembar_cek_nisn_dapodik' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status' => 'required|in:Not Started,In Progress,Done'
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.unique' => 'NIK sudah terdaftar, gunakan NIK yang berbeda',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'fotokopi_ijazah_sttb_hilang.file' => 'File harus berupa file yang valid.',
            'fotokopi_ijazah_sttb_hilang.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_ijazah_sttb_hilang.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_akta_kelahiran.file' => 'File harus berupa file yang valid.',
            'fotokopi_akta_kelahiran.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_akta_kelahiran.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_keterangan_kehilangan.file' => 'File harus berupa file yang valid.',
            'surat_keterangan_kehilangan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_keterangan_kehilangan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_pernyataan_tanggungjawab.file' => 'File harus berupa file yang valid.',
            'surat_pernyataan_tanggungjawab.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_pernyataan_tanggungjawab.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_keterangan_saksi.file' => 'File harus berupa file yang valid.',
            'surat_keterangan_saksi.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_keterangan_saksi.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'dokumen_kewenangan.file' => 'File harus berupa file yang valid.',
            'dokumen_kewenangan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'dokumen_kewenangan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'lembar_cek_nisn_dapodik.file' => 'File harus berupa file yang valid.',
            'lembar_cek_nisn_dapodik.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'lembar_cek_nisn_dapodik.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_fotokopi_ijazah_sttb_hilang = NULL;
        $filename_fotokopi_akta_kelahiran = NULL;
        $filename_surat_keterangan_kehilangan = NULL;
        $filename_surat_pernyataan_tanggungjawab = NULL;
        $filename_surat_keterangan_saksi = NULL;
        $filename_dokumen_kewenangan = NULL;
        $filename_lembar_cek_nisn_dapodik = NULL;
        
        $path_fotokopi_ijazah_sttb_hilang = NULL;
        $path_fotokopi_akta_kelahiran = NULL;
        $path_surat_keterangan_kehilangan = NULL;
        $path_surat_pernyataan_tanggungjawab = NULL;
        $path_surat_keterangan_saksi = NULL;
        $path_dokumen_kewenangan = NULL;
        $path_lembar_cek_nisn_dapodik = NULL;
        
        if ($request->hasFile('fotokopi_ijazah_sttb_hilang')) {
            $file_fotokopi_ijazah_sttb_hilang = $request->file('fotokopi_ijazah_sttb_hilang');
            $extension_fotokopi_ijazah_sttb_hilang = $file_fotokopi_ijazah_sttb_hilang->getClientOriginalExtension();
            
            $filename_fotokopi_ijazah_sttb_hilang = time() . '_fotokopi_ijazah_sttb_hilang.' . $extension_fotokopi_ijazah_sttb_hilang;
            $path_fotokopi_ijazah_sttb_hilang = 'uploads/surat_pengganti_ijazah_sttb_hilang/fotokopi_ijazah_sttb_hilang/';
            $file_fotokopi_ijazah_sttb_hilang->move($path_fotokopi_ijazah_sttb_hilang, $filename_fotokopi_ijazah_sttb_hilang);
        }
        
        if ($request->hasFile('fotokopi_akta_kelahiran')) {
            $file_fotokopi_akta_kelahiran = $request->file('fotokopi_akta_kelahiran');
            $extension_fotokopi_akta_kelahiran = $file_fotokopi_akta_kelahiran->getClientOriginalExtension();
            
            $filename_fotokopi_akta_kelahiran = time() . '_fotokopi_akta_kelahiran.' . $extension_fotokopi_akta_kelahiran;
            $path_fotokopi_akta_kelahiran = 'uploads/surat_pengganti_ijazah_sttb_hilang/fotokopi_akta_kelahiran/';
            $file_fotokopi_akta_kelahiran->move($path_fotokopi_akta_kelahiran, $filename_fotokopi_akta_kelahiran);
        }

        if ($request->hasFile('surat_keterangan_kehilangan')) {
            $file_surat_keterangan_kehilangan = $request->file('surat_keterangan_kehilangan');
            $extension_surat_keterangan_kehilangan = $file_surat_keterangan_kehilangan->getClientOriginalExtension();
            
            $filename_surat_keterangan_kehilangan = time() . '_surat_keterangan_kehilangan.' . $extension_surat_keterangan_kehilangan;
            $path_surat_keterangan_kehilangan = 'uploads/surat_pengganti_ijazah_sttb_hilang/surat_keterangan_kehilangan/';
            $file_surat_keterangan_kehilangan->move($path_surat_keterangan_kehilangan, $filename_surat_keterangan_kehilangan);
        }
        if ($request->hasFile('surat_pernyataan_tanggungjawab')) {
            $file_surat_pernyataan_tanggungjawab = $request->file('surat_pernyataan_tanggungjawab');
            $extension_surat_pernyataan_tanggungjawab = $file_surat_pernyataan_tanggungjawab->getClientOriginalExtension();
            
            $filename_surat_pernyataan_tanggungjawab = time() . '_surat_pernyataan_tanggungjawab.' . $extension_surat_pernyataan_tanggungjawab;
            $path_surat_pernyataan_tanggungjawab = 'uploads/surat_pengganti_ijazah_sttb_hilang/surat_pernyataan_tanggungjawab/';
            $file_surat_pernyataan_tanggungjawab->move($path_surat_pernyataan_tanggungjawab, $filename_surat_pernyataan_tanggungjawab);
        }
        if ($request->hasFile('surat_keterangan_saksi')) {
            $file_surat_keterangan_saksi = $request->file('surat_keterangan_saksi');
            $extension_surat_keterangan_saksi = $file_surat_keterangan_saksi->getClientOriginalExtension();
            
            $filename_surat_keterangan_saksi = time() . '_surat_keterangan_saksi.' . $extension_surat_keterangan_saksi;
            $path_surat_keterangan_saksi = 'uploads/surat_pengganti_ijazah_sttb_hilang/surat_keterangan_saksi/';
            $file_surat_keterangan_saksi->move($path_surat_keterangan_saksi, $filename_surat_keterangan_saksi);
        }
        if ($request->hasFile('dokumen_kewenangan')) {
            $file_dokumen_kewenangan = $request->file('dokumen_kewenangan');
            $extension_dokumen_kewenangan = $file_dokumen_kewenangan->getClientOriginalExtension();
            
            $filename_dokumen_kewenangan = time() . '_dokumen_kewenangan.' . $extension_dokumen_kewenangan;
            $path_dokumen_kewenangan = 'uploads/surat_pengganti_ijazah_sttb_hilang/dokumen_kewenangan/';
            $file_dokumen_kewenangan->move($path_dokumen_kewenangan, $filename_dokumen_kewenangan);
        }
        if ($request->hasFile('lembar_cek_nisn_dapodik')) {
            $file_lembar_cek_nisn_dapodik = $request->file('lembar_cek_nisn_dapodik');
            $extension_lembar_cek_nisn_dapodik = $file_lembar_cek_nisn_dapodik->getClientOriginalExtension();
            
            $filename_lembar_cek_nisn_dapodik = time() . '_lembar_cek_nisn_dapodik.' . $extension_lembar_cek_nisn_dapodik;
            $path_lembar_cek_nisn_dapodik = 'uploads/surat_pengganti_ijazah_sttb_hilang/lembar_cek_nisn_dapodik/';
            $file_lembar_cek_nisn_dapodik->move($path_lembar_cek_nisn_dapodik, $filename_lembar_cek_nisn_dapodik);
        }

        SuratPenggantiIjazahSTTBHilang::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'fotokopi_ijazah_sttb_hilang' => $path_fotokopi_ijazah_sttb_hilang.$filename_fotokopi_ijazah_sttb_hilang,
            'fotokopi_akta_kelahiran' => $path_fotokopi_akta_kelahiran.$filename_fotokopi_akta_kelahiran,
            'surat_keterangan_kehilangan' => $path_surat_keterangan_kehilangan.$filename_surat_keterangan_kehilangan,
            'surat_pernyataan_tanggungjawab	' => $path_surat_pernyataan_tanggungjawab	.$filename_surat_pernyataan_tanggungjawab	,
            'surat_keterangan_saksi' => $path_surat_keterangan_saksi.$filename_surat_keterangan_saksi,
            'dokumen_kewenangan' => $path_dokumen_kewenangan.$filename_dokumen_kewenangan,
            'lembar_cek_nisn_dapodik' => $path_lembar_cek_nisn_dapodik.$filename_lembar_cek_nisn_dapodik,
            'status' => $request->status,
        ]);

        return redirect('surat_pengganti_ijazah_sttb_hilang')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $surat_pengganti_ijazah_sttb_hilang = SuratPenggantiIjazahSTTBHilang::findOrFail($id);
        return view('surat_pengganti_ijazah_sttb_hilang.show', compact('surat_pengganti_ijazah_sttb_hilang'));
    }

    public function edit(int $id)
    {
        $surat_pengganti_ijazah_sttb_hilang = SuratPenggantiIjazahSTTBHilang::findOrFail($id);
        return view('surat_pengganti_ijazah_sttb_hilang.edit', compact('surat_pengganti_ijazah_sttb_hilang'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'fotokopi_ijazah_sttb_hilang' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'surat_keterangan_kehilangan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_pernyataan_tanggungjawab' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'surat_keterangan_saksi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_kewenangan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'lembar_cek_nisn_dapodik' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status' => 'required|in:Not Started,In Progress,Done',

        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'fotokopi_ijazah_sttb_hilang.file' => 'File harus berupa file yang valid.',
            'fotokopi_ijazah_sttb_hilang.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_ijazah_sttb_hilang.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_akta_kelahiran.file' => 'File harus berupa file yang valid.',
            'fotokopi_akta_kelahiran.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_akta_kelahiran.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_keterangan_kehilangan.file' => 'File harus berupa file yang valid.',
            'surat_keterangan_kehilangan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_keterangan_kehilangan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_pernyataan_tanggungjawab.file' => 'File harus berupa file yang valid.',
            'surat_pernyataan_tanggungjawab.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_pernyataan_tanggungjawab.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_keterangan_saksi.file' => 'File harus berupa file yang valid.',
            'surat_keterangan_saksi.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_keterangan_saksi.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'dokumen_kewenangan.file' => 'File harus berupa file yang valid.',
            'dokumen_kewenangan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'dokumen_kewenangan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'lembar_cek_nisn_dapodik.file' => 'File harus berupa file yang valid.',
            'lembar_cek_nisn_dapodik.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'lembar_cek_nisn_dapodik.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $surat_pengganti_ijazah_sttb_hilang = SuratPenggantiIjazahSTTBHilang::findOrFail($id);
        
        if ($request->hasFile('fotokopi_ijazah_sttb_hilang')) {
            $file_fotokopi_ijazah_sttb_hilang = $request->file('fotokopi_ijazah_sttb_hilang');
            $extension_fotokopi_ijazah_sttb_hilang = $file_fotokopi_ijazah_sttb_hilang->getClientOriginalExtension();
            
            $filename_fotokopi_ijazah_sttb_hilang = time() . '_fotokopi_ijazah_sttb_hilang.' . $extension_fotokopi_ijazah_sttb_hilang;
            $path_fotokopi_ijazah_sttb_hilang = 'uploads/surat_pengganti_ijazah_sttb_hilang/fotokopi_ijazah_sttb_hilang/';
            $file_fotokopi_ijazah_sttb_hilang->move($path_fotokopi_ijazah_sttb_hilang, $filename_fotokopi_ijazah_sttb_hilang);

            if(File::exists($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang)){
                File::delete($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang);
            }

            $surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang = $path_fotokopi_ijazah_sttb_hilang . $filename_fotokopi_ijazah_sttb_hilang;
        }
        
        if ($request->hasFile('fotokopi_akta_kelahiran')) {
            $file_fotokopi_akta_kelahiran = $request->file('fotokopi_akta_kelahiran');
            $extension_fotokopi_akta_kelahiran = $file_fotokopi_akta_kelahiran->getClientOriginalExtension();
            
            $filename_fotokopi_akta_kelahiran = time() . '_fotokopi_akta_kelahiran.' . $extension_fotokopi_akta_kelahiran;
            $path_fotokopi_akta_kelahiran = 'uploads/surat_pengganti_ijazah_sttb_hilang/fotokopi_akta_kelahiran/';
            $file_fotokopi_akta_kelahiran->move($path_fotokopi_akta_kelahiran, $filename_fotokopi_akta_kelahiran);

            if(File::exists($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran)){
                File::delete($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran);
            }

            $surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran = $path_fotokopi_akta_kelahiran . $filename_fotokopi_akta_kelahiran;
        }
        if ($request->hasFile('surat_keterangan_kehilangan')) {
            $file_surat_keterangan_kehilangan = $request->file('surat_keterangan_kehilangan');
            $extension_surat_keterangan_kehilangan = $file_surat_keterangan_kehilangan->getClientOriginalExtension();
            
            $filename_surat_keterangan_kehilangan = time() . '_surat_keterangan_kehilangan.' . $extension_surat_keterangan_kehilangan;
            $path_surat_keterangan_kehilangan = 'uploads/surat_pengganti_ijazah_sttb_hilang/surat_keterangan_kehilangan/';
            $file_surat_keterangan_kehilangan->move($path_surat_keterangan_kehilangan, $filename_surat_keterangan_kehilangan);

            if(File::exists($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan)){
                File::delete($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan);
            }

            $surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan = $path_surat_keterangan_kehilangan . $filename_surat_keterangan_kehilangan;
        }
        if ($request->hasFile('surat_pernyataan_tanggungjawab')) {
            $file_surat_pernyataan_tanggungjawab = $request->file('surat_pernyataan_tanggungjawab');
            $extension_surat_pernyataan_tanggungjawab = $file_surat_pernyataan_tanggungjawab->getClientOriginalExtension();
            
            $filename_surat_pernyataan_tanggungjawab = time() . '_surat_pernyataan_tanggungjawab.' . $extension_surat_pernyataan_tanggungjawab;
            $path_surat_pernyataan_tanggungjawab = 'uploads/surat_pengganti_ijazah_sttb_hilang/surat_pernyataan_tanggungjawab/';
            $file_surat_pernyataan_tanggungjawab->move($path_surat_pernyataan_tanggungjawab, $filename_surat_pernyataan_tanggungjawab);

            if(File::exists($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab)){
                File::delete($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab);
            }

            $surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab = $path_surat_pernyataan_tanggungjawab . $filename_surat_pernyataan_tanggungjawab;
        }
        if ($request->hasFile('surat_keterangan_saksi')) {
            $file_surat_keterangan_saksi = $request->file('surat_keterangan_saksi');
            $extension_surat_keterangan_saksi = $file_surat_keterangan_saksi->getClientOriginalExtension();
            
            $filename_surat_keterangan_saksi = time() . '_surat_keterangan_saksi.' . $extension_surat_keterangan_saksi;
            $path_surat_keterangan_saksi = 'uploads/surat_pengganti_ijazah_sttb_hilang/surat_keterangan_saksi/';
            $file_surat_keterangan_saksi->move($path_surat_keterangan_saksi, $filename_surat_keterangan_saksi);

            if(File::exists($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi)){
                File::delete($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi);
            }

            $surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi = $path_surat_keterangan_saksi . $filename_surat_keterangan_saksi;
        }
        if ($request->hasFile('dokumen_kewenangan')) {
            $file_dokumen_kewenangan = $request->file('dokumen_kewenangan');
            $extension_dokumen_kewenangan = $file_dokumen_kewenangan->getClientOriginalExtension();
            
            $filename_dokumen_kewenangan = time() . '_dokumen_kewenangan.' . $extension_dokumen_kewenangan;
            $path_dokumen_kewenangan = 'uploads/surat_pengganti_ijazah_sttb_hilang/dokumen_kewenangan/';
            $file_dokumen_kewenangan->move($path_dokumen_kewenangan, $filename_dokumen_kewenangan);

            if(File::exists($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan)){
                File::delete($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan);
            }

            $surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan = $path_dokumen_kewenangan . $filename_dokumen_kewenangan;
        }
        if ($request->hasFile('lembar_cek_nisn_dapodik')) {
            $file_lembar_cek_nisn_dapodik = $request->file('lembar_cek_nisn_dapodik');
            $extension_lembar_cek_nisn_dapodik = $file_lembar_cek_nisn_dapodik->getClientOriginalExtension();
            
            $filename_lembar_cek_nisn_dapodik = time() . '_lembar_cek_nisn_dapodik.' . $extension_lembar_cek_nisn_dapodik;
            $path_lembar_cek_nisn_dapodik = 'uploads/surat_pengganti_ijazah_sttb_hilang/lembar_cek_nisn_dapodik/';
            $file_lembar_cek_nisn_dapodik->move($path_lembar_cek_nisn_dapodik, $filename_lembar_cek_nisn_dapodik);

            if(File::exists($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik)){
                File::delete($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik);
            }

            $surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik = $path_lembar_cek_nisn_dapodik . $filename_lembar_cek_nisn_dapodik;
        }

        $surat_pengganti_ijazah_sttb_hilang->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'fotokopi_ijazah_sttb_hilang' => $surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang ?? $surat_pengganti_ijazah_sttb_hilang->getOriginal('fotokopi_ijazah_sttb_hilang'),
            'fotokopi_akta_kelahiran' => $surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran ?? $surat_pengganti_ijazah_sttb_hilang->getOriginal('fotokopi_akta_kelahiran'),
            'surat_keterangan_kehilangan' => $surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan ?? $surat_pengganti_ijazah_sttb_hilang->getOriginal('surat_keterangan_kehilangan'),
            'surat_pernyataan_tanggungjawab' => $surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab ?? $surat_pengganti_ijazah_sttb_hilang->getOriginal('surat_pernyataan_tanggungjawab'),
            'surat_keterangan_saksi' => $surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi ?? $surat_pengganti_ijazah_sttb_hilang->getOriginal('surat_keterangan_saksi'),
            'dokumen_kewenangan' => $surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan ?? $surat_pengganti_ijazah_sttb_hilang->getOriginal('dokumen_kewenangan'),
            'lembar_cek_nisn_dapodik' => $surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik ?? $surat_pengganti_ijazah_sttb_hilang->getOriginal('lembar_cek_nisn_dapodik'),
            'status' => $request->status,
        ]);

        return redirect('surat_pengganti_ijazah_sttb_hilang')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $surat_pengganti_ijazah_sttb_hilang = SuratPenggantiIjazahSTTBHilang::findOrFail($id);
        if(File::exists($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang)){
            File::delete($surat_pengganti_ijazah_sttb_hilang->fotokopi_ijazah_sttb_hilang);
        }
        if(File::exists($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran)){
            File::delete($surat_pengganti_ijazah_sttb_hilang->fotokopi_akta_kelahiran);
        }
        if(File::exists($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan)){
            File::delete($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_kehilangan);
        }
        if(File::exists($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab)){
            File::delete($surat_pengganti_ijazah_sttb_hilang->surat_pernyataan_tanggungjawab);
        }
        if(File::exists($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi)){
            File::delete($surat_pengganti_ijazah_sttb_hilang->surat_keterangan_saksi);
        }
        if(File::exists($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan)){
            File::delete($surat_pengganti_ijazah_sttb_hilang->dokumen_kewenangan);
        }
        if(File::exists($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik)){
            File::delete($surat_pengganti_ijazah_sttb_hilang->lembar_cek_nisn_dapodik);
        }

        $surat_pengganti_ijazah_sttb_hilang -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'surat_pengganti_ijazah_sttb_hilang.xlsx';
        return Excel::download(new SuratPenggantiIjazahSTTBHilangExport, $fillname);
    }

    public function generatePDF()
    {
        $surat_pengganti_ijazah_sttb_hilang = SuratPenggantiIjazahSTTBHilang::get();
        $data = [
            'title' => 'Daftar Data Surat Pengganti Ijazah/STTB Hilang',
            'date' => date('d/m/Y'),
            'surat_pengganti_ijazah_sttb_hilang' => $surat_pengganti_ijazah_sttb_hilang
        ];

        $pdf = PDF::loadView('surat_pengganti_ijazah_sttb_hilang.pdf', $data);
        return $pdf->download('data.pdf');
    }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = SuratPenggantiIjazahSTTBHilang::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
