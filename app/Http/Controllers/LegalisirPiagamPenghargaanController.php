<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegalisirPiagamPenghargaan;
use App\Exports\LegalisirPiagamPenghargaanExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LegalisirPiagamPenghargaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search2;
        if ($search) {
            $legalisir_piagam_penghargaan = LegalisirPiagamPenghargaan::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $legalisir_piagam_penghargaan = LegalisirPiagamPenghargaan::paginate(10);
        }
        return view('legalisir_piagam_penghargaan.index', compact('legalisir_piagam_penghargaan', 'search'));
    }


    public function create()
    {
        return view('legalisir_piagam_penghargaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:legalisir_piagam_penghargaan,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'piagam_penghargaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_piagam_penghargaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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
            'piagam_penghargaan.file' => 'File harus berupa file yang valid.',
            'piagam_penghargaan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'piagam_penghargaan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_piagam_penghargaan.file' => 'File harus berupa file yang valid.',
            'fotokopi_piagam_penghargaan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_piagam_penghargaan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_piagam_penghargaan = NULL;
        $filename_fotokopi_piagam_penghargaan = NULL;
        
        $path_piagam_penghargaan = NULL;
        $path_fotokopi_piagam_penghargaan = NULL;
        
        if ($request->hasFile('piagam_penghargaan')) {
            $file_piagam_penghargaan = $request->file('piagam_penghargaan');
            $extension_piagam_penghargaan = $file_piagam_penghargaan->getClientOriginalExtension();
            
            $filename_piagam_penghargaan = time() . '_surat_permohonan.' . $extension_piagam_penghargaan;
            $path_piagam_penghargaan = 'uploads/legalisir_piagam_penghargaan/piagam_penghargaan/';
            $file_piagam_penghargaan->move($path_piagam_penghargaan, $filename_piagam_penghargaan);
        }
        
        if ($request->hasFile('fotokopi_piagam_penghargaan')) {
            $file_fotokopi_piagam_penghargaan = $request->file('fotokopi_piagam_penghargaan');
            $extension_fotokopi_piagam_penghargaan = $file_fotokopi_piagam_penghargaan->getClientOriginalExtension();
            
            $filename_fotokopi_piagam_penghargaan = time() . '_fotokopi_piagam_penghargaan.' . $extension_fotokopi_piagam_penghargaan;
            $path_fotokopi_piagam_penghargaan = 'uploads/legalisir_piagam_penghargaan/fotokopi_piagam_penghargaan/';
            $file_fotokopi_piagam_penghargaan->move($path_fotokopi_piagam_penghargaan, $filename_fotokopi_piagam_penghargaan);
        }

        LegalisirPiagamPenghargaan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'piagam_penghargaan' => $path_piagam_penghargaan.$filename_piagam_penghargaan,
            'fotokopi_piagam_penghargaan' => $path_fotokopi_piagam_penghargaan.$filename_fotokopi_piagam_penghargaan,
            'status' => $request->status,
        ]);

        return redirect('legalisir_piagam_penghargaan')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $legalisir_piagam_penghargaan = LegalisirPiagamPenghargaan::findOrFail($id);
        return view('legalisir_piagam_penghargaan.show', compact('legalisir_piagam_penghargaan'));
    }

    public function edit(int $id)
    {
        $legalisir_piagam_penghargaan = LegalisirPiagamPenghargaan::findOrFail($id);
        return view('legalisir_piagam_penghargaan.edit', compact('legalisir_piagam_penghargaan'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'piagam_penghargaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_piagam_penghargaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status' => 'required|in:Not Started,In Progress,Done',

        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'piagam_penghargaan.file' => 'File harus berupa file yang valid.',
            'piagam_penghargaan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'piagam_penghargaan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_piagam_penghargaan.file' => 'File harus berupa file yang valid.',
            'fotokopi_piagam_penghargaan.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_piagam_penghargaan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $legalisir_piagam_penghargaan = LegalisirPiagamPenghargaan::findOrFail($id);
        
        if ($request->hasFile('piagam_penghargaan')) {
            $file_piagam_penghargaan = $request->file('piagam_penghargaan');
            $extension_piagam_penghargaan = $file_piagam_penghargaan->getClientOriginalExtension();
            
            $filename_piagam_penghargaan = time() . '_piagam_penghargaan.' . $extension_piagam_penghargaan;
            $path_piagam_penghargaan = 'uploads/legalisir_piagam_penghargaan/piagam_penghargaan/';
            $file_piagam_penghargaan->move($path_piagam_penghargaan, $filename_piagam_penghargaan);

            if(File::exists($legalisir_piagam_penghargaan->piagam_penghargaan)){
                File::delete($legalisir_piagam_penghargaan->piagam_penghargaan);
            }

            $legalisir_piagam_penghargaan->piagam_penghargaan = $path_piagam_penghargaan . $filename_piagam_penghargaan;
        }
        
        if ($request->hasFile('fotokopi_piagam_penghargaan')) {
            $file_fotokopi_piagam_penghargaan = $request->file('fotokopi_piagam_penghargaan');
            $extension_fotokopi_piagam_penghargaan = $file_fotokopi_piagam_penghargaan->getClientOriginalExtension();
            
            $filename_fotokopi_piagam_penghargaan = time() . '_fotokopi_piagam_penghargaan.' . $extension_fotokopi_piagam_penghargaan;
            $path_fotokopi_piagam_penghargaan = 'uploads/legalisir_piagam_penghargaan/fotokopi_piagam_penghargaan/';
            $file_fotokopi_piagam_penghargaan->move($path_fotokopi_piagam_penghargaan, $filename_fotokopi_piagam_penghargaan);

            if(File::exists($legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan)){
                File::delete($legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan);
            }

            $legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan = $path_fotokopi_piagam_penghargaan . $filename_fotokopi_piagam_penghargaan;
        }

        $legalisir_piagam_penghargaan->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'piagam_penghargaan' => $legalisir_piagam_penghargaan->piagam_penghargaan ?? $legalisir_piagam_penghargaan->getOriginal('piagam_penghargaan'),
            'fotokopi_piagam_penghargaan' => $legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan ?? $legalisir_piagam_penghargaan->getOriginal('fotokopi_piagam_penghargaan'),
            'status' => $request->status,
        ]);

        return redirect('legalisir_piagam_penghargaan')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $legalisir_piagam_penghargaan = LegalisirPiagamPenghargaan::findOrFail($id);
        if(File::exists($legalisir_piagam_penghargaan->piagam_penghargaan)){
            File::delete($legalisir_piagam_penghargaan->piagam_penghargaan);
        }
        if(File::exists($legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan)){
            File::delete($legalisir_piagam_penghargaan->fotokopi_piagam_penghargaan);
        }

        $legalisir_piagam_penghargaan -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'legalisir_piagam_penghargaan.xlsx';
        return Excel::download(new LegalisirPiagamPenghargaanExport, $fillname);
    }

    public function generatePDF()
    {
        $legalisir_piagam_penghargaan = LegalisirPiagamPenghargaan::get();
        $data = [
            'title' => 'Daftar Data Layanan Pengaduan',
            'date' => date('d/m/Y'),
            'legalisir_piagam_penghargaan' => $legalisir_piagam_penghargaan
        ];

        $pdf = PDF::loadView('legalisir_piagam_penghargaan.pdf', $data);
        return $pdf->download('data.pdf');
    }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = LegalisirPiagamPenghargaan::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
