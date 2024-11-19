<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SuratKeteranganRalatIjazahSTTB;
use App\Exports\SuratKeteranganRalatIjazahSTTBExport;

class SuratKeteranganRalatIjazahSTTBController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search2;
        if ($search) {
            $surat_keterangan_ralat_ijazah_sttb = SuratKeteranganRalatIjazahSTTB::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $surat_keterangan_ralat_ijazah_sttb = SuratKeteranganRalatIjazahSTTB::paginate(10);
        }
        return view('surat_keterangan_ralat_ijazah_sttb.index', compact('surat_keterangan_ralat_ijazah_sttb', 'search'));
    }


    public function create()
    {
        return view('surat_keterangan_ralat_ijazah_sttb.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:surat_keterangan_ralat_ijazah_sttb,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'fotokopi_ijazah_sttb' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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
            'fotokopi_ijazah_sttb.file' => 'File harus berupa file yang valid.',
            'fotokopi_ijazah_sttb.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_ijazah_sttb.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_akta_kelahiran.file' => 'File harus berupa file yang valid.',
            'fotokopi_akta_kelahiran.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_akta_kelahiran.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'dokumen_kewenangan.file' => 'File harus berupa file yang valid.',
            'dokumen_kewenangan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'dokumen_kewenangan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'lembar_cek_nisn_dapodik.file' => 'File harus berupa file yang valid.',
            'lembar_cek_nisn_dapodik.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'lembar_cek_nisn_dapodik.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_fotokopi_ijazah_sttb = NULL;
        $filename_fotokopi_akta_kelahiran = NULL;
        $filename_dokumen_kewenangan = NULL;
        $filename_lembar_cek_nisn_dapodik = NULL;
        
        $path_fotokopi_ijazah_sttb = NULL;
        $path_fotokopi_akta_kelahiran = NULL;
        $path_dokumen_kewenangan = NULL;
        $path_lembar_cek_nisn_dapodik = NULL;
        
        if ($request->hasFile('fotokopi_ijazah_sttb')) {
            $file_fotokopi_ijazah_sttb = $request->file('fotokopi_ijazah_sttb');
            $extension_fotokopi_ijazah_sttb = $file_fotokopi_ijazah_sttb->getClientOriginalExtension();
            
            $filename_fotokopi_ijazah_sttb = time() . '_fotokopi_ijazah_sttb.' . $extension_fotokopi_ijazah_sttb;
            $path_fotokopi_ijazah_sttb = 'uploads/surat_keterangan_ralat_ijazah_sttb/fotokopi_ijazah_sttb/';
            $file_fotokopi_ijazah_sttb->move($path_fotokopi_ijazah_sttb, $filename_fotokopi_ijazah_sttb);
        }
        
        if ($request->hasFile('fotokopi_akta_kelahiran')) {
            $file_fotokopi_akta_kelahiran = $request->file('fotokopi_akta_kelahiran');
            $extension_fotokopi_akta_kelahiran = $file_fotokopi_akta_kelahiran->getClientOriginalExtension();
            
            $filename_fotokopi_akta_kelahiran = time() . '_fotokopi_akta_kelahiran.' . $extension_fotokopi_akta_kelahiran;
            $path_fotokopi_akta_kelahiran = 'uploads/surat_keterangan_ralat_ijazah_sttb/fotokopi_akta_kelahiran/';
            $file_fotokopi_akta_kelahiran->move($path_fotokopi_akta_kelahiran, $filename_fotokopi_akta_kelahiran);
        }
        if ($request->hasFile('dokumen_kewenangan')) {
            $file_dokumen_kewenangan = $request->file('dokumen_kewenangan');
            $extension_dokumen_kewenangan = $file_dokumen_kewenangan->getClientOriginalExtension();
            
            $filename_dokumen_kewenangan = time() . '_dokumen_kewenangan.' . $extension_dokumen_kewenangan;
            $path_dokumen_kewenangan = 'uploads/surat_keterangan_ralat_ijazah_sttb/dokumen_kewenangan/';
            $file_dokumen_kewenangan->move($path_dokumen_kewenangan, $filename_dokumen_kewenangan);
        }
        if ($request->hasFile('lembar_cek_nisn_dapodik')) {
            $file_lembar_cek_nisn_dapodik = $request->file('lembar_cek_nisn_dapodik');
            $extension_lembar_cek_nisn_dapodik = $file_lembar_cek_nisn_dapodik->getClientOriginalExtension();
            
            $filename_lembar_cek_nisn_dapodik = time() . '_lembar_cek_nisn_dapodik.' . $extension_lembar_cek_nisn_dapodik;
            $path_lembar_cek_nisn_dapodik = 'uploads/surat_keterangan_ralat_ijazah_sttb/lembar_cek_nisn_dapodik/';
            $file_lembar_cek_nisn_dapodik->move($path_lembar_cek_nisn_dapodik, $filename_lembar_cek_nisn_dapodik);
        }

        SuratKeteranganRalatIjazahSTTB::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'fotokopi_ijazah_sttb' => $path_fotokopi_ijazah_sttb.$filename_fotokopi_ijazah_sttb,
            'fotokopi_akta_kelahiran' => $path_fotokopi_akta_kelahiran.$filename_fotokopi_akta_kelahiran,
            'dokumen_kewenangan' => $path_dokumen_kewenangan.$filename_dokumen_kewenangan,
            'lembar_cek_nisn_dapodik' => $path_lembar_cek_nisn_dapodik.$filename_lembar_cek_nisn_dapodik,
            'status' => $request->status,
        ]);

        return redirect('surat_keterangan_ralat_ijazah_sttb')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $surat_keterangan_ralat_ijazah_sttb = SuratKeteranganRalatIjazahSTTB::findOrFail($id);
        return view('surat_keterangan_ralat_ijazah_sttb.show', compact('surat_keterangan_ralat_ijazah_sttb'));
    }

    public function edit(int $id)
    {
        $surat_keterangan_ralat_ijazah_sttb = SuratKeteranganRalatIjazahSTTB::findOrFail($id);
        return view('surat_keterangan_ralat_ijazah_sttb.edit', compact('surat_keterangan_ralat_ijazah_sttb'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'fotokopi_ijazah_sttb' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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
            'fotokopi_ijazah_sttb.file' => 'File harus berupa file yang valid.',
            'fotokopi_ijazah_sttb.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_ijazah_sttb.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_akta_kelahiran.file' => 'File harus berupa file yang valid.',
            'fotokopi_akta_kelahiran.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_akta_kelahiran.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'dokumen_kewenangan.file' => 'File harus berupa file yang valid.',
            'dokumen_kewenangan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'dokumen_kewenangan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'lembar_cek_nisn_dapodik.file' => 'File harus berupa file yang valid.',
            'lembar_cek_nisn_dapodik.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'lembar_cek_nisn_dapodik.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $surat_keterangan_ralat_ijazah_sttb = SuratKeteranganRalatIjazahSTTB::findOrFail($id);
        
        if ($request->hasFile('fotokopi_ijazah_sttb')) {
            $file_fotokopi_ijazah_sttb = $request->file('fotokopi_ijazah_sttb');
            $extension_fotokopi_ijazah_sttb = $file_fotokopi_ijazah_sttb->getClientOriginalExtension();
            
            $filename_fotokopi_ijazah_sttb = time() . '_fotokopi_ijazah_sttb.' . $extension_fotokopi_ijazah_sttb;
            $path_fotokopi_ijazah_sttb = 'uploads/surat_keterangan_ralat_ijazah_sttb/fotokopi_ijazah_sttb/';
            $file_fotokopi_ijazah_sttb->move($path_fotokopi_ijazah_sttb, $filename_fotokopi_ijazah_sttb);

            if(File::exists($surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb)){
                File::delete($surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb);
            }

            $surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb = $path_fotokopi_ijazah_sttb . $filename_fotokopi_ijazah_sttb;
        }
        
        if ($request->hasFile('fotokopi_akta_kelahiran')) {
            $file_fotokopi_akta_kelahiran = $request->file('fotokopi_akta_kelahiran');
            $extension_fotokopi_akta_kelahiran = $file_fotokopi_akta_kelahiran->getClientOriginalExtension();
            
            $filename_fotokopi_akta_kelahiran = time() . '_fotokopi_akta_kelahiran.' . $extension_fotokopi_akta_kelahiran;
            $path_fotokopi_akta_kelahiran = 'uploads/surat_keterangan_ralat_ijazah_sttb/fotokopi_akta_kelahiran/';
            $file_fotokopi_akta_kelahiran->move($path_fotokopi_akta_kelahiran, $filename_fotokopi_akta_kelahiran);

            if(File::exists($surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran)){
                File::delete($surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran);
            }

            $surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran = $path_fotokopi_akta_kelahiran . $filename_fotokopi_akta_kelahiran;
        }
        if ($request->hasFile('dokumen_kewenangan')) {
            $file_dokumen_kewenangan = $request->file('dokumen_kewenangan');
            $extension_dokumen_kewenangan = $file_dokumen_kewenangan->getClientOriginalExtension();
            
            $filename_dokumen_kewenangan = time() . '_dokumen_kewenangan.' . $extension_dokumen_kewenangan;
            $path_dokumen_kewenangan = 'uploads/surat_keterangan_ralat_ijazah_sttb/dokumen_kewenangan/';
            $file_dokumen_kewenangan->move($path_dokumen_kewenangan, $filename_dokumen_kewenangan);

            if(File::exists($surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan)){
                File::delete($surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan);
            }

            $surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan = $path_dokumen_kewenangan . $filename_dokumen_kewenangan;
        }
        if ($request->hasFile('lembar_cek_nisn_dapodik')) {
            $file_lembar_cek_nisn_dapodik = $request->file('lembar_cek_nisn_dapodik');
            $extension_lembar_cek_nisn_dapodik = $file_lembar_cek_nisn_dapodik->getClientOriginalExtension();
            
            $filename_lembar_cek_nisn_dapodik = time() . '_lembar_cek_nisn_dapodik.' . $extension_lembar_cek_nisn_dapodik;
            $path_lembar_cek_nisn_dapodik = 'uploads/surat_keterangan_ralat_ijazah_sttb/lembar_cek_nisn_dapodik/';
            $file_lembar_cek_nisn_dapodik->move($path_lembar_cek_nisn_dapodik, $filename_lembar_cek_nisn_dapodik);

            if(File::exists($surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik)){
                File::delete($surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik);
            }

            $surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik = $path_lembar_cek_nisn_dapodik . $filename_lembar_cek_nisn_dapodik;
        }

        $surat_keterangan_ralat_ijazah_sttb->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'fotokopi_ijazah_sttb' => $surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb ?? $surat_keterangan_ralat_ijazah_sttb->getOriginal('fotokopi_ijazah_sttb'),
            'fotokopi_akta_kelahiran' => $surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran ?? $surat_keterangan_ralat_ijazah_sttb->getOriginal('fotokopi_akta_kelahiran'),
            'dokumen_kewenangan' => $surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan ?? $surat_keterangan_ralat_ijazah_sttb->getOriginal('dokumen_kewenangan'),
            'lembar_cek_nisn_dapodik' => $surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik ?? $surat_keterangan_ralat_ijazah_sttb->getOriginal('lembar_cek_nisn_dapodik'),
            'status' => $request->status,
        ]);

        return redirect('surat_keterangan_ralat_ijazah_sttb')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $surat_keterangan_ralat_ijazah_sttb = SuratKeteranganRalatIjazahSTTB::findOrFail($id);
        if(File::exists($surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb)){
            File::delete($surat_keterangan_ralat_ijazah_sttb->fotokopi_ijazah_sttb);
        }
        if(File::exists($surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran)){
            File::delete($surat_keterangan_ralat_ijazah_sttb->fotokopi_akta_kelahiran);
        }
        if(File::exists($surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan)){
            File::delete($surat_keterangan_ralat_ijazah_sttb->dokumen_kewenangan);
        }
        if(File::exists($surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik)){
            File::delete($surat_keterangan_ralat_ijazah_sttb->lembar_cek_nisn_dapodik);
        }

        $surat_keterangan_ralat_ijazah_sttb -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'surat_keterangan_ralat_ijazah_sttb.xlsx';
        return Excel::download(new SuratKeteranganRalatIjazahSTTBExport, $fillname);
    }

    public function generatePDF()
    {
        $surat_keterangan_ralat_ijazah_sttb = SuratKeteranganRalatIjazahSTTB::get();
        $data = [
            'title' => 'Daftar Data Surat Keterangan Ralat Ijazah/STTB',
            'date' => date('d/m/Y'),
            'surat_keterangan_ralat_ijazah_sttb' => $surat_keterangan_ralat_ijazah_sttb
        ];

        $pdf = PDF::loadView('surat_keterangan_ralat_ijazah_sttb.pdf', $data);
        return $pdf->download('data.pdf');
    }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = SuratKeteranganRalatIjazahSTTB::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
