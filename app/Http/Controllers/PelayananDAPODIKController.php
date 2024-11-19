<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelayananDAPODIK;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PelayananDAPODIKExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PelayananDAPODIKController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search2;
        if ($search) {
            $pelayanan_dapodik = PelayananDAPODIK::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $pelayanan_dapodik = PelayananDAPODIK::paginate(10);
        }
        return view('pelayanan_dapodik.index', compact('pelayanan_dapodik', 'search'));
    }


    public function create()
    {
        return view('pelayanan_dapodik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:pelayanan_dapodik,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'surat_pertanggungjawaban' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'gtk_persemester' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'usul_sktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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
            'surat_pertanggungjawaban.file' => 'File harus berupa file yang valid.',
            'surat_pertanggungjawaban.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_pertanggungjawaban.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'gtk_persemester.file' => 'File harus berupa file yang valid.',
            'gtk_persemester.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'gtk_persemester.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'usul_sktp.file' => 'File harus berupa file yang valid.',
            'usul_sktp.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'usul_sktp.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_surat_pertanggungjawaban = NULL;
        $filename_gtk_persemester = NULL;
        $filename_usul_sktp = NULL;
        
        $path_surat_pertanggungjawaban = NULL;
        $path_gtk_persemester = NULL;
        $path_usul_sktp = NULL;
        
        if ($request->hasFile('surat_pertanggungjawaban')) {
            $file_surat_pertanggungjawaban = $request->file('surat_pertanggungjawaban');
            $extension_surat_pertanggungjawaban = $file_surat_pertanggungjawaban->getClientOriginalExtension();
            
            $filename_surat_pertanggungjawaban = time() . '_surat_pertanggungjawaban.' . $extension_surat_pertanggungjawaban;
            $path_surat_pertanggungjawaban = 'uploads/pelayanan_dapodik/surat_pertanggungjawaban/';
            $file_surat_pertanggungjawaban->move($path_surat_pertanggungjawaban, $filename_surat_pertanggungjawaban);
        }
        
        if ($request->hasFile('gtk_persemester')) {
            $file_gtk_persemester = $request->file('gtk_persemester');
            $extension_gtk_persemester = $file_gtk_persemester->getClientOriginalExtension();
            
            $filename_gtk_persemester = time() . '_gtk_persemester.' . $extension_gtk_persemester;
            $path_gtk_persemester = 'uploads/pelayanan_dapodik/gtk_persemester/';
            $file_gtk_persemester->move($path_gtk_persemester, $filename_gtk_persemester);
        }

        if ($request->hasFile('usul_sktp')) {
            $file_usul_sktp = $request->file('usul_sktp');
            $extension_usul_sktp = $file_usul_sktp->getClientOriginalExtension();
            
            $filename_usul_sktp = time() . '_usul_sktp.' . $extension_usul_sktp;
            $path_usul_sktp = 'uploads/pelayanan_dapodik/usul_sktp/';
            $file_usul_sktp->move($path_usul_sktp, $filename_usul_sktp);
        }

        PelayananDAPODIK::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'surat_pertanggungjawaban' => $path_surat_pertanggungjawaban.$filename_surat_pertanggungjawaban,
            'gtk_persemester' => $path_gtk_persemester.$filename_gtk_persemester,
            'usul_sktp' => $path_usul_sktp.$filename_usul_sktp,
            'status' => $request->status,
        ]);

        return redirect('pelayanan_dapodik')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $pelayanan_dapodik = PelayananDAPODIK::findOrFail($id);
        return view('pelayanan_dapodik.show', compact('pelayanan_dapodik'));
    }

    public function edit(int $id)
    {
        $pelayanan_dapodik = PelayananDAPODIK::findOrFail($id);
        return view('pelayanan_dapodik.edit', compact('pelayanan_dapodik'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'surat_pertanggungjawaban' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'gtk_persemester' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'usul_sktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status' => 'required|in:Not Started,In Progress,Done',

        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'surat_pertanggungjawaban.file' => 'File harus berupa file yang valid.',
            'surat_pertanggungjawaban.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'surat_pertanggungjawaban.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'gtk_persemester.file' => 'File harus berupa file yang valid.',
            'gtk_persemester.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'gtk_persemester.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'usul_sktp.file' => 'File harus berupa file yang valid.',
            'usul_sktp.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'usul_sktp.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $pelayanan_dapodik = PelayananDAPODIK::findOrFail($id);
        
        if ($request->hasFile('surat_pertanggungjawaban')) {
            $file_surat_pertanggungjawaban = $request->file('surat_pertanggungjawaban');
            $extension_surat_pertanggungjawaban = $file_surat_pertanggungjawaban->getClientOriginalExtension();
            
            $filename_surat_pertanggungjawaban = time() . '_surat_pertanggungjawaban.' . $extension_surat_pertanggungjawaban;
            $path_surat_pertanggungjawaban = 'uploads/pelayanan_dapodik/surat_pertanggungjawaban/';
            $file_surat_pertanggungjawaban->move($path_surat_pertanggungjawaban, $filename_surat_pertanggungjawaban);

            if(File::exists($pelayanan_dapodik->surat_pertanggungjawaban)){
                File::delete($pelayanan_dapodik->surat_pertanggungjawaban);
            }

            $pelayanan_dapodik->surat_pertanggungjawaban = $path_surat_pertanggungjawaban . $filename_surat_pertanggungjawaban;
        }
        
        if ($request->hasFile('gtk_persemester')) {
            $file_gtk_persemester = $request->file('gtk_persemester');
            $extension_gtk_persemester = $file_gtk_persemester->getClientOriginalExtension();
            
            $filename_gtk_persemester = time() . '_gtk_persemester.' . $extension_gtk_persemester;
            $path_gtk_persemester = 'uploads/pelayanan_dapodik/gtk_persemester/';
            $file_gtk_persemester->move($path_gtk_persemester, $filename_gtk_persemester);

            if(File::exists($pelayanan_dapodik->gtk_persemester)){
                File::delete($pelayanan_dapodik->gtk_persemester);
            }

            $pelayanan_dapodik->gtk_persemester = $path_gtk_persemester . $filename_gtk_persemester;
        }

        if ($request->hasFile('usul_sktp')) {
            $file_usul_sktp = $request->file('usul_sktp');
            $extension_usul_sktp = $file_usul_sktp->getClientOriginalExtension();
            
            $filename_usul_sktp = time() . '_usul_sktp.' . $extension_usul_sktp;
            $path_usul_sktp = 'uploads/pelayanan_dapodik/usul_sktp/';
            $file_usul_sktp->move($path_usul_sktp, $filename_usul_sktp);

            if(File::exists($pelayanan_dapodik->usul_sktp)){
                File::delete($pelayanan_dapodik->usul_sktp);
            }

            $pelayanan_dapodik->usul_sktp = $path_usul_sktp . $filename_usul_sktp;
        }

        $pelayanan_dapodik->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'surat_pertanggungjawaban' => $pelayanan_dapodik->surat_pertanggungjawaban ?? $pelayanan_dapodik->getOriginal('surat_pertanggungjawaban'),
            'gtk_persemester' => $pelayanan_dapodik->gtk_persemester ?? $pelayanan_dapodik->getOriginal('gtk_persemester'),
            'usul_sktp' => $pelayanan_dapodik->usul_sktp ?? $pelayanan_dapodik->getOriginal('usul_sktp'),
            'status' => $request->status,
        ]);

        return redirect('pelayanan_dapodik')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $pelayanan_dapodik = PelayananDAPODIK::findOrFail($id);
        if(File::exists($pelayanan_dapodik->surat_pertanggungjawaban)){
            File::delete($pelayanan_dapodik->surat_pertanggungjawaban);
        }
        if(File::exists($pelayanan_dapodik->gtk_persemester)){
            File::delete($pelayanan_dapodik->gtk_persemester);
        }
        if(File::exists($pelayanan_dapodik->usul_sktp)){
            File::delete($pelayanan_dapodik->usul_sktp);
        }

        $pelayanan_dapodik -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'pelayanan_dapodik.xlsx';
        return Excel::download(new PelayananDAPODIKExport, $fillname);
    }

    public function generatePDF()
    {
        $pelayanan_dapodik = PelayananDAPODIK::get();
        $data = [
            'title' => 'Daftar Data Legalisir Fotokopi Ijazah/STTB',
            'date' => date('d/m/Y'),
            'pelayanan_dapodik' => $pelayanan_dapodik
        ];

        $pdf = PDF::loadView('pelayanan_dapodik.pdf', $data);
        return $pdf->download('data.pdf');
    }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = PelayananDAPODIK::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
