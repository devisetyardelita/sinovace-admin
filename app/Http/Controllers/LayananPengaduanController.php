<?php

namespace App\Http\Controllers;

use App\Models\LayananPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LayananpengaduanExport;

class LayananPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search2;

        // Jika ada pencarian, lakukan filter
        if ($search) {
            $layanan_pengaduan = LayananPengaduan::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            // Jika tidak ada pencarian, tampilkan semua data
            $layanan_pengaduan = LayananPengaduan::paginate(10);
        }
        return view('layanan_pengaduan.index', compact('layanan_pengaduan', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layanan_pengaduan.create');
        // return view ('layanan_pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:layanan_pengaduan,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'file_surat_permohonan_pengajuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'foto_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto_bukti_pengaduan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
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
            'file_surat_permohonan_pengajuan.file' => 'File harus berupa file yang valid.',
            'file_surat_permohonan_pengajuan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'file_surat_permohonan_pengajuan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'foto_ktp.file' => 'File harus berupa file yang valid.',
            'foto_ktp.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'foto_ktp.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'foto_bukti_pengaduan.file' => 'File harus berupa file yang valid.',
            'foto_bukti_pengaduan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'foto_bukti_pengaduan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_surat = NULL;
        $filename_ktp = NULL;
        $filename_bukti = NULL;
        
        $path_surat = NULL;
        $path_ktp = NULL;
        $path_bukti = NULL;
        
        // Handling file_surat_permohonan_pengajuan
        if ($request->hasFile('file_surat_permohonan_pengajuan')) {
            $file_surat = $request->file('file_surat_permohonan_pengajuan');
            $extension_surat = $file_surat->getClientOriginalExtension();
            
            $filename_surat = time() . '_surat_permohonan.' . $extension_surat;
            $path_surat = 'uploads/layanan_pengaduan/surat_permohonan_pengajuan/';
            $file_surat->move($path_surat, $filename_surat);
        }
        
        // Handling foto_ktp
        if ($request->hasFile('foto_ktp')) {
            $file_ktp = $request->file('foto_ktp');
            $extension_ktp = $file_ktp->getClientOriginalExtension();
            
            $filename_ktp = time() . '_ktp.' . $extension_ktp;
            $path_ktp = 'uploads/layanan_pengaduan/ktp/';
            $file_ktp->move($path_ktp, $filename_ktp);
        }
        
        // Handling foto_bukti_pengaduan
        if ($request->hasFile('foto_bukti_pengaduan')) {
            $file_bukti = $request->file('foto_bukti_pengaduan');
            $extension_bukti = $file_bukti->getClientOriginalExtension();
            
            $filename_bukti = time() . '_bukti_pengaduan.' . $extension_bukti;
            $path_bukti = 'uploads/layanan_pengaduan/bukti_pengaduan/';
            $file_bukti->move($path_bukti, $filename_bukti);
        }

        LayananPengaduan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'file_surat_permohonan_pengajuan' => $path_surat.$filename_surat,
            'foto_ktp' => $path_ktp.$filename_ktp,
            'foto_bukti_pengaduan' => $path_bukti.$filename_bukti,
            'status' => $request->status,
        ]);

        return redirect('layanan_pengaduan')->with('status', 'Data Pengaduan berhasil ditambahkan!');
        // return redirect('/dashboard')->with('status', 'Profile updated!');
        // return $request;

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $layanan_pengaduan = LayananPengaduan::findOrFail($id);
        return view('layanan_pengaduan.show', compact('layanan_pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $layanan_pengaduan = LayananPengaduan::findOrFail($id);
        return view('layanan_pengaduan.edit', compact('layanan_pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'file_surat_permohonan_pengajuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'foto_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto_bukti_pengaduan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'status' => 'required|in:Not Started,In Progress,Done',

        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'file_surat_permohonan_pengajuan.file' => 'File harus berupa file yang valid.',
            'file_surat_permohonan_pengajuan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'file_surat_permohonan_pengajuan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'foto_ktp.file' => 'File harus berupa file yang valid.',
            'foto_ktp.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'foto_ktp.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'foto_bukti_pengaduan.file' => 'File harus berupa file yang valid.',
            'foto_bukti_pengaduan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'foto_bukti_pengaduan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $layanan_pengaduan = LayananPengaduan::findOrFail($id);
        
        // Handling file_surat_permohonan_pengajuan
        if ($request->hasFile('file_surat_permohonan_pengajuan')) {
            $file_surat = $request->file('file_surat_permohonan_pengajuan');
            $extension_surat = $file_surat->getClientOriginalExtension();
            
            $filename_surat = time() . '_surat_permohonan.' . $extension_surat;
            $path_surat = 'uploads/layanan_pengaduan/surat_permohonan_pengajuan/';
            $file_surat->move($path_surat, $filename_surat);

            if(File::exists($layanan_pengaduan->file_surat_permohonan_pengajuan)){
                File::delete($layanan_pengaduan->file_surat_permohonan_pengajuan);
            }

            // Simpan path file baru ke database
            $layanan_pengaduan->file_surat_permohonan_pengajuan = $path_surat . $filename_surat;
        }
        
        // Handling foto_ktp
        if ($request->hasFile('foto_ktp')) {
            $file_ktp = $request->file('foto_ktp');
            $extension_ktp = $file_ktp->getClientOriginalExtension();
            
            $filename_ktp = time() . '_ktp.' . $extension_ktp;
            $path_ktp = 'uploads/layanan_pengaduan/ktp/';
            $file_ktp->move($path_ktp, $filename_ktp);

            if(File::exists($layanan_pengaduan->foto_ktp)){
                File::delete($layanan_pengaduan->foto_ktp);
            }

            // Simpan path file baru ke database
            $layanan_pengaduan->foto_ktp = $path_ktp . $filename_ktp;
        }
        
        // Handling foto_bukti_pengaduan
        if ($request->hasFile('foto_bukti_pengaduan')) {
            $file_bukti = $request->file('foto_bukti_pengaduan');
            $extension_bukti = $file_bukti->getClientOriginalExtension();
            
            $filename_bukti = time() . '_bukti_pengaduan.' . $extension_bukti;
            $path_bukti = 'uploads/layanan_pengaduan/bukti_pengaduan/';
            $file_bukti->move($path_bukti, $filename_bukti);

            if(File::exists($layanan_pengaduan->foto_bukti_pengaduan)){
                File::delete($layanan_pengaduan->foto_bukti_pengaduan);
            }

            // Simpan path file baru ke database
            $layanan_pengaduan->foto_bukti_pengaduan = $path_bukti . $filename_bukti;
        }

        $layanan_pengaduan->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            // Hanya update file jika ada file baru, kalau tidak tetap gunakan file lama
            'file_surat_permohonan_pengajuan' => $layanan_pengaduan->file_surat_permohonan_pengajuan ?? $layanan_pengaduan->getOriginal('file_surat_permohonan_pengajuan'),
            'foto_ktp' => $layanan_pengaduan->foto_ktp ?? $layanan_pengaduan->getOriginal('foto_ktp'),
            'foto_bukti_pengaduan' => $layanan_pengaduan->foto_bukti_pengaduan ?? $layanan_pengaduan->getOriginal('foto_bukti_pengaduan'),
            'status' => $request->status,
            // 'file_surat_permohonan_pengajuan' => $request->file_surat_permohonan_pengajuan,
            // 'foto_ktp' => $request->foto_ktp,
            // 'foto_bukti_pengaduan' => $request->foto_bukti_pengaduan,
        ]);

        // return redirect()->back()->with('status', 'Data Pengaduan berhasil diperbaharui!');
        return redirect('layanan_pengaduan')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan_pengaduan = LayananPengaduan::findOrFail($id);
        if(File::exists($layanan_pengaduan->file_surat_permohonan_pengajuan)){
            File::delete($layanan_pengaduan->file_surat_permohonan_pengajuan);
        }
        if(File::exists($layanan_pengaduan->foto_ktp)){
            File::delete($layanan_pengaduan->foto_ktp);
        }
        if(File::exists($layanan_pengaduan->foto_bukti_pengaduan)){
            File::delete($layanan_pengaduan->foto_bukti_pengaduan);
        }

        $layanan_pengaduan -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'layanan_pengaduan.xlsx';
        return Excel::download(new LayananPengaduanExport, $fillname);
    }

    // public function search(Request $request) 
    // {
    //     $search = $request->search;
    
    //     $layanan_pengaduan = LayananPengaduan::where(function($query) use ($search) {
    //         $query->where('nama', 'like', '%' . $search . '%')
    //               ->orWhere('alamat', 'like', '%' . $search . '%')
    //               ->orWhere('nik', 'like', '%' . $search . '%')
    //               ->orWhere('no_hp', 'like', '%' . $search . '%');
    //     })->paginate(10);
    
    //     return view('layanan_pengaduan.index', compact('layanan_pengaduan', 'search'));
    // }

    // public function filter(Request $request)
    // {
    //     $query = LayananPengaduan::query();
    //     $status = LayananPengaduan::all();

    //     if($request->ajax()){
    //         if(empty($request->status)){
    //             $statuses = $query->get();
    //         }
    //         else{
    //             $statuses = $query->where(['status'=>$request->status])->get();
    //         }
    //         return response()->json(['statuses'=>$statuses]);
    //     }
    //     $statuses = $query->get();
    //     return view('layanan_pengaduan.index', compact('status', 'statuses'));
    
    // }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = LayananPengaduan::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
    
    

    
    
    
}
