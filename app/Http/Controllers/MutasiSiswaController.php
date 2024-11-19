<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiSiswa;
use App\Exports\MutasiSiswaExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class MutasiSiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search2;
        if ($search) {
            $mutasi_siswa = MutasiSiswa::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $mutasi_siswa = MutasiSiswa::paginate(10);
        }
        return view('mutasi_siswa.index', compact('mutasi_siswa', 'search'));
    }


    public function create()
    {
        return view('mutasi_siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:mutasi_siswa,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'surat_rekomendasi_sekolah_asal' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_rekomendasi_sekolah_tujuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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
            'surat_rekomendasi_sekolah_asal.file' => 'File harus berupa file yang valid.',
            'surat_rekomendasi_sekolah_asal.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_rekomendasi_sekolah_asal.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_rekomendasi_sekolah_tujuan.file' => 'File harus berupa file yang valid.',
            'surat_rekomendasi_sekolah_tujuan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_rekomendasi_sekolah_tujuan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_surat_rekomendasi_sekolah_asal = NULL;
        $filename_surat_rekomendasi_sekolah_tujuan = NULL;
        
        $path_surat_rekomendasi_sekolah_asal = NULL;
        $path_surat_rekomendasi_sekolah_tujuan = NULL;
        
        if ($request->hasFile('surat_rekomendasi_sekolah_asal')) {
            $file_surat_rekomendasi_sekolah_asal = $request->file('surat_rekomendasi_sekolah_asal');
            $extension_surat_rekomendasi_sekolah_asal = $file_surat_rekomendasi_sekolah_asal->getClientOriginalExtension();
            
            $filename_surat_rekomendasi_sekolah_asal = time() . '_surat_rekomendasi_sekolah_asal.' . $extension_surat_rekomendasi_sekolah_asal;
            $path_surat_rekomendasi_sekolah_asal = 'uploads/mutasi_siswa/surat_rekomendasi_sekolah_asal/';
            $file_surat_rekomendasi_sekolah_asal->move($path_surat_rekomendasi_sekolah_asal, $filename_surat_rekomendasi_sekolah_asal);
        }
        
        if ($request->hasFile('surat_rekomendasi_sekolah_tujuan')) {
            $file_surat_rekomendasi_sekolah_tujuan = $request->file('surat_rekomendasi_sekolah_tujuan');
            $extension_surat_rekomendasi_sekolah_tujuan = $file_surat_rekomendasi_sekolah_tujuan->getClientOriginalExtension();
            
            $filename_surat_rekomendasi_sekolah_tujuan = time() . '_surat_rekomendasi_sekolah_tujuan.' . $extension_surat_rekomendasi_sekolah_tujuan;
            $path_surat_rekomendasi_sekolah_tujuan = 'uploads/mutasi_siswa/surat_rekomendasi_sekolah_tujuan/';
            $file_surat_rekomendasi_sekolah_tujuan->move($path_surat_rekomendasi_sekolah_tujuan, $filename_surat_rekomendasi_sekolah_tujuan);
        }

        MutasiSiswa::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'surat_rekomendasi_sekolah_asal' => $path_surat_rekomendasi_sekolah_asal.$filename_surat_rekomendasi_sekolah_asal,
            'surat_rekomendasi_sekolah_tujuan' => $path_surat_rekomendasi_sekolah_tujuan.$filename_surat_rekomendasi_sekolah_tujuan,
            'status' => $request->status,
        ]);

        return redirect('mutasi_siswa')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $mutasi_siswa = MutasiSiswa::findOrFail($id);
        return view('mutasi_siswa.show', compact('mutasi_siswa'));
    }

    public function edit(int $id)
    {
        $mutasi_siswa = MutasiSiswa::findOrFail($id);
        return view('mutasi_siswa.edit', compact('mutasi_siswa'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'surat_rekomendasi_sekolah_asal' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_rekomendasi_sekolah_tujuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status' => 'required|in:Not Started,In Progress,Done',

        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'surat_rekomendasi_sekolah_asal.file' => 'File harus berupa file yang valid.',
            'surat_rekomendasi_sekolah_asal.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_rekomendasi_sekolah_asal.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'surat_rekomendasi_sekolah_tujuan.file' => 'File harus berupa file yang valid.',
            'surat_rekomendasi_sekolah_tujuan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_rekomendasi_sekolah_tujuan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $mutasi_siswa = MutasiSiswa::findOrFail($id);
        
        if ($request->hasFile('surat_rekomendasi_sekolah_asal')) {
            $file_surat_rekomendasi_sekolah_asal = $request->file('surat_rekomendasi_sekolah_asal');
            $extension_surat_rekomendasi_sekolah_asal = $file_surat_rekomendasi_sekolah_asal->getClientOriginalExtension();
            
            $filename_surat_rekomendasi_sekolah_asal = time() . '_surat_rekomendasi_sekolah_asal.' . $extension_surat_rekomendasi_sekolah_asal;
            $path_surat_rekomendasi_sekolah_asal = 'uploads/mutasi_siswa/surat_rekomendasi_sekolah_asal/';
            $file_surat_rekomendasi_sekolah_asal->move($path_surat_rekomendasi_sekolah_asal, $filename_surat_rekomendasi_sekolah_asal);

            if(File::exists($mutasi_siswa->surat_rekomendasi_sekolah_asal)){
                File::delete($mutasi_siswa->surat_rekomendasi_sekolah_asal);
            }

            $mutasi_siswa->surat_rekomendasi_sekolah_asal = $path_surat_rekomendasi_sekolah_asal . $filename_surat_rekomendasi_sekolah_asal;
        }
        
        if ($request->hasFile('surat_rekomendasi_sekolah_tujuan')) {
            $file_surat_rekomendasi_sekolah_tujuan = $request->file('surat_rekomendasi_sekolah_tujuan');
            $extension_surat_rekomendasi_sekolah_tujuan = $file_surat_rekomendasi_sekolah_tujuan->getClientOriginalExtension();
            
            $filename_surat_rekomendasi_sekolah_tujuan = time() . '_surat_rekomendasi_sekolah_tujuan.' . $extension_surat_rekomendasi_sekolah_tujuan;
            $path_surat_rekomendasi_sekolah_tujuan = 'uploads/mutasi_siswa/surat_rekomendasi_sekolah_tujuan/';
            $file_surat_rekomendasi_sekolah_tujuan->move($path_surat_rekomendasi_sekolah_tujuan, $filename_surat_rekomendasi_sekolah_tujuan);

            if(File::exists($mutasi_siswa->surat_rekomendasi_sekolah_tujuan)){
                File::delete($mutasi_siswa->surat_rekomendasi_sekolah_tujuan);
            }

            $mutasi_siswa->surat_rekomendasi_sekolah_tujuan = $path_surat_rekomendasi_sekolah_tujuan . $filename_surat_rekomendasi_sekolah_tujuan;
        }

        $mutasi_siswa->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'surat_rekomendasi_sekolah_asal' => $mutasi_siswa->surat_rekomendasi_sekolah_asal ?? $mutasi_siswa->getOriginal('surat_rekomendasi_sekolah_asal'),
            'surat_rekomendasi_sekolah_tujuan' => $mutasi_siswa->surat_rekomendasi_sekolah_tujuan ?? $mutasi_siswa->getOriginal('surat_rekomendasi_sekolah_tujuan'),
            'status' => $request->status,
        ]);

        return redirect('mutasi_siswa')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $mutasi_siswa = MutasiSiswa::findOrFail($id);
        if(File::exists($mutasi_siswa->surat_rekomendasi_sekolah_asal)){
            File::delete($mutasi_siswa->surat_rekomendasi_sekolah_asal);
        }
        if(File::exists($mutasi_siswa->surat_rekomendasi_sekolah_tujuan)){
            File::delete($mutasi_siswa->surat_rekomendasi_sekolah_tujuan);
        }

        $mutasi_siswa -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'mutasi_siswa.xlsx';
        return Excel::download(new MutasiSiswaExport, $fillname);
    }

    public function generatePDF()
    {
        $mutasi_siswa = MutasiSiswa::get();
        $data = [
            'title' => 'Daftar Data Mutasi Siswa',
            'date' => date('d/m/Y'),
            'mutasi_siswa' => $mutasi_siswa
        ];

        $pdf = PDF::loadView('mutasi_siswa.pdf', $data);
        return $pdf->download('data.pdf');
    }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = MutasiSiswa::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
