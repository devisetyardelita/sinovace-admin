<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengelolaanBOS;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengelolaanBOSExport;

class PengelolaanBOSController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search2;
        if ($search) {
            $pengelolaan_dana_bos = PengelolaanBOS::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $pengelolaan_dana_bos = PengelolaanBOS::paginate(10);
        }
        return view('pengelolaan_dana_bos.index', compact('pengelolaan_dana_bos', 'search'));
    }


    public function create()
    {
        return view('pengelolaan_dana_bos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:pengelolaan_dana_bos,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'dokumen_pertanggungjawaban_keuangan	' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_pengantar_kepala_sekolah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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
            'dokumen_pertanggungjawaban_keuangan	.file' => 'File harus berupa file yang valid.',
            'dokumen_pertanggungjawaban_keuangan	.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'dokumen_pertanggungjawaban_keuangan	.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_pengantar_kepala_sekolah.file' => 'File harus berupa file yang valid.',
            'surat_pengantar_kepala_sekolah.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_pengantar_kepala_sekolah.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_dokumen_pertanggungjawaban_keuangan	 = NULL;
        $filename_surat_pengantar_kepala_sekolah = NULL;
        
        $path_dokumen_pertanggungjawaban_keuangan	 = NULL;
        $path_surat_pengantar_kepala_sekolah = NULL;
        
        if ($request->hasFile('dokumen_pertanggungjawaban_keuangan	')) {
            $file_dokumen_pertanggungjawaban_keuangan	 = $request->file('dokumen_pertanggungjawaban_keuangan	');
            $extension_dokumen_pertanggungjawaban_keuangan	 = $file_dokumen_pertanggungjawaban_keuangan	->getClientOriginalExtension();
            
            $filename_dokumen_pertanggungjawaban_keuangan	 = time() . '_dokumen_pertanggungjawaban_keuangan	.' . $extension_dokumen_pertanggungjawaban_keuangan	;
            $path_dokumen_pertanggungjawaban_keuangan	 = 'uploads/pengelolaan_dana_bos/dokumen_pertanggungjawaban_keuangan	/';
            $file_dokumen_pertanggungjawaban_keuangan	->move($path_dokumen_pertanggungjawaban_keuangan	, $filename_dokumen_pertanggungjawaban_keuangan	);
        }
        
        if ($request->hasFile('surat_pengantar_kepala_sekolah')) {
            $file_surat_pengantar_kepala_sekolah = $request->file('surat_pengantar_kepala_sekolah');
            $extension_surat_pengantar_kepala_sekolah = $file_surat_pengantar_kepala_sekolah->getClientOriginalExtension();
            
            $filename_surat_pengantar_kepala_sekolah = time() . '_surat_pengantar_kepala_sekolah.' . $extension_surat_pengantar_kepala_sekolah;
            $path_surat_pengantar_kepala_sekolah = 'uploads/pengelolaan_dana_bos/surat_pengantar_kepala_sekolah/';
            $file_surat_pengantar_kepala_sekolah->move($path_surat_pengantar_kepala_sekolah, $filename_surat_pengantar_kepala_sekolah);
        }

        PengelolaanBOS::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'dokumen_pertanggungjawaban_keuangan	' => $path_dokumen_pertanggungjawaban_keuangan	.$filename_dokumen_pertanggungjawaban_keuangan	,
            'surat_pengantar_kepala_sekolah' => $path_surat_pengantar_kepala_sekolah.$filename_surat_pengantar_kepala_sekolah,
            'status' => $request->status,
        ]);

        return redirect('pengelolaan_dana_bos')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $pengelolaan_dana_bos = PengelolaanBOS::findOrFail($id);
        return view('pengelolaan_dana_bos.show', compact('pengelolaan_dana_bos'));
    }

    public function edit(int $id)
    {
        $pengelolaan_dana_bos = PengelolaanBOS::findOrFail($id);
        return view('pengelolaan_dana_bos.edit', compact('pengelolaan_dana_bos'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'dokumen_pertanggungjawaban_keuangan	' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_pengantar_kepala_sekolah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status' => 'required|in:Not Started,In Progress,Done',

        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'dokumen_pertanggungjawaban_keuangan	.file' => 'File harus berupa file yang valid.',
            'dokumen_pertanggungjawaban_keuangan	.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'dokumen_pertanggungjawaban_keuangan	.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_pengantar_kepala_sekolah.file' => 'File harus berupa file yang valid.',
            'surat_pengantar_kepala_sekolah.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_pengantar_kepala_sekolah.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $pengelolaan_dana_bos = PengelolaanBOS::findOrFail($id);
        
        if ($request->hasFile('dokumen_pertanggungjawaban_keuangan	')) {
            $file_dokumen_pertanggungjawaban_keuangan	 = $request->file('dokumen_pertanggungjawaban_keuangan	');
            $extension_dokumen_pertanggungjawaban_keuangan	 = $file_dokumen_pertanggungjawaban_keuangan	->getClientOriginalExtension();
            
            $filename_dokumen_pertanggungjawaban_keuangan	 = time() . '_dokumen_pertanggungjawaban_keuangan	.' . $extension_dokumen_pertanggungjawaban_keuangan	;
            $path_dokumen_pertanggungjawaban_keuangan	 = 'uploads/pengelolaan_dana_bos/dokumen_pertanggungjawaban_keuangan	/';
            $file_dokumen_pertanggungjawaban_keuangan	->move($path_dokumen_pertanggungjawaban_keuangan	, $filename_dokumen_pertanggungjawaban_keuangan	);

            if(File::exists($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan	)){
                File::delete($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan	);
            }

            $pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan	 = $path_dokumen_pertanggungjawaban_keuangan	 . $filename_dokumen_pertanggungjawaban_keuangan	;
        }
        
        if ($request->hasFile('surat_pengantar_kepala_sekolah')) {
            $file_surat_pengantar_kepala_sekolah = $request->file('surat_pengantar_kepala_sekolah');
            $extension_surat_pengantar_kepala_sekolah = $file_surat_pengantar_kepala_sekolah->getClientOriginalExtension();
            
            $filename_surat_pengantar_kepala_sekolah = time() . '_surat_pengantar_kepala_sekolah.' . $extension_surat_pengantar_kepala_sekolah;
            $path_surat_pengantar_kepala_sekolah = 'uploads/pengelolaan_dana_bos/surat_pengantar_kepala_sekolah/';
            $file_surat_pengantar_kepala_sekolah->move($path_surat_pengantar_kepala_sekolah, $filename_surat_pengantar_kepala_sekolah);

            if(File::exists($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah)){
                File::delete($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah);
            }

            $pengelolaan_dana_bos->surat_pengantar_kepala_sekolah = $path_surat_pengantar_kepala_sekolah . $filename_surat_pengantar_kepala_sekolah;
        }

        $pengelolaan_dana_bos->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'dokumen_pertanggungjawaban_keuangan	' => $pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan	 ?? $pengelolaan_dana_bos->getOriginal('dokumen_pertanggungjawaban_keuangan	'),
            'surat_pengantar_kepala_sekolah' => $pengelolaan_dana_bos->surat_pengantar_kepala_sekolah ?? $pengelolaan_dana_bos->getOriginal('surat_pengantar_kepala_sekolah'),
            'status' => $request->status,
        ]);

        return redirect('pengelolaan_dana_bos')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $pengelolaan_dana_bos = PengelolaanBOS::findOrFail($id);
        if(File::exists($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan	)){
            File::delete($pengelolaan_dana_bos->dokumen_pertanggungjawaban_keuangan	);
        }
        if(File::exists($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah)){
            File::delete($pengelolaan_dana_bos->surat_pengantar_kepala_sekolah);
        }
        if(File::exists($pengelolaan_dana_bos->foto_bukti_pengaduan)){
            File::delete($pengelolaan_dana_bos->foto_bukti_pengaduan);
        }

        $pengelolaan_dana_bos -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'pengelolaan_dana_bos.xlsx';
        return Excel::download(new PengelolaanBOSExport, $fillname);
    }

    public function generatePDF()
    {
        $pengelolaan_dana_bos = PengelolaanBOS::get();
        $data = [
            'title' => 'Daftar Data Pengelolaan BOS',
            'date' => date('d/m/Y'),
            'pengelolaan_dana_bos' => $pengelolaan_dana_bos
        ];

        $pdf = PDF::loadView('pengelolaan_dana_bos.pdf', $data);
        return $pdf->download('data.pdf');
    }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = PengelolaanBOS::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
