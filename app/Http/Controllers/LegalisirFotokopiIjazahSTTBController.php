<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LegalisirFotokopiIjazahSTTB;
use App\Exports\LegalisirFotokopiIjazahSTTBExport;

class LegalisirFotokopiIjazahSTTBController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search2;
        if ($search) {
            $legalisir_fotokopi_ijazah_sttb = LegalisirFotokopiIjazahSTTB::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $legalisir_fotokopi_ijazah_sttb = LegalisirFotokopiIjazahSTTB::paginate(10);
        }
        return view('legalisir_fotokopi_ijazah_sttb.index', compact('legalisir_fotokopi_ijazah_sttb', 'search'));
    }


    public function create()
    {
        return view('legalisir_fotokopi_ijazah_sttb.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|unique:legalisir_fotokopi_ijazah_sttb,nik|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'ijazah_sttb_asli' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_ijazah_sttb' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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
            'ijazah_sttb_asli.file' => 'File harus berupa file yang valid.',
            'ijazah_sttb_asli.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'ijazah_sttb_asli.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_ijazah_sttb.file' => 'File harus berupa file yang valid.',
            'fotokopi_ijazah_sttb.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_ijazah_sttb.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_ijazah_sttb_asli = NULL;
        $filename_fotokopi_ijazah_sttb = NULL;
        
        $path_ijazah_sttb_asli = NULL;
        $path_fotokopi_ijazah_sttb = NULL;
        
        if ($request->hasFile('ijazah_sttb_asli')) {
            $file_ijazah_sttb_asli = $request->file('ijazah_sttb_asli');
            $extension_ijazah_sttb_asli = $file_ijazah_sttb_asli->getClientOriginalExtension();
            
            $filename_ijazah_sttb_asli = time() . '_ijazah_sttb_asli.' . $extension_ijazah_sttb_asli;
            $path_ijazah_sttb_asli = 'uploads/legalisir_fotokopi_ijazah_sttb/ijazah_sttb_asli/';
            $file_ijazah_sttb_asli->move($path_ijazah_sttb_asli, $filename_ijazah_sttb_asli);
        }
        
        if ($request->hasFile('fotokopi_ijazah_sttb')) {
            $file_fotokopi_ijazah_sttb = $request->file('fotokopi_ijazah_sttb');
            $extension_fotokopi_ijazah_sttb = $file_fotokopi_ijazah_sttb->getClientOriginalExtension();
            
            $filename_fotokopi_ijazah_sttb = time() . '_fotokopi_ijazah_sttb.' . $extension_fotokopi_ijazah_sttb;
            $path_fotokopi_ijazah_sttb = 'uploads/legalisir_fotokopi_ijazah_sttb/fotokopi_ijazah_sttb/';
            $file_fotokopi_ijazah_sttb->move($path_fotokopi_ijazah_sttb, $filename_fotokopi_ijazah_sttb);
        }

        LegalisirFotokopiIjazahSTTB::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'ijazah_sttb_asli' => $path_ijazah_sttb_asli.$filename_ijazah_sttb_asli,
            'fotokopi_ijazah_sttb' => $path_fotokopi_ijazah_sttb.$filename_fotokopi_ijazah_sttb,
            'status' => $request->status,
        ]);

        return redirect('legalisir_fotokopi_ijazah_sttb')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $legalisir_fotokopi_ijazah_sttb = LegalisirFotokopiIjazahSTTB::findOrFail($id);
        return view('legalisir_fotokopi_ijazah_sttb.show', compact('legalisir_fotokopi_ijazah_sttb'));
    }

    public function edit(int $id)
    {
        $legalisir_fotokopi_ijazah_sttb = LegalisirFotokopiIjazahSTTB::findOrFail($id);
        return view('legalisir_fotokopi_ijazah_sttb.edit', compact('legalisir_fotokopi_ijazah_sttb'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'no_hp' => 'required|max:20',
            'ijazah_sttb_asli' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'fotokopi_ijazah_sttb' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status' => 'required|in:Not Started,In Progress,Done',

        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter',
            'ijazah_sttb_asli.file' => 'File harus berupa file yang valid.',
            'ijazah_sttb_asli.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'ijazah_sttb_asli.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'fotokopi_ijazah_sttb.file' => 'File harus berupa file yang valid.',
            'fotokopi_ijazah_sttb.mimes' => 'File harus berupa pdf, jpg, jpeg, atau png.',
            'fotokopi_ijazah_sttb.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $legalisir_fotokopi_ijazah_sttb = LegalisirFotokopiIjazahSTTB::findOrFail($id);
        
        if ($request->hasFile('ijazah_sttb_asli')) {
            $file_ijazah_sttb_asli = $request->file('ijazah_sttb_asli');
            $extension_ijazah_sttb_asli = $file_ijazah_sttb_asli->getClientOriginalExtension();
            
            $filename_ijazah_sttb_asli = time() . '_ijazah_sttb_asli.' . $extension_ijazah_sttb_asli;
            $path_ijazah_sttb_asli = 'uploads/legalisir_fotokopi_ijazah_sttb/ijazah_sttb_asli/';
            $file_ijazah_sttb_asli->move($path_ijazah_sttb_asli, $filename_ijazah_sttb_asli);

            if(File::exists($legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli)){
                File::delete($legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli);
            }

            $legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli = $path_ijazah_sttb_asli . $filename_ijazah_sttb_asli;
        }
        
        if ($request->hasFile('fotokopi_ijazah_sttb')) {
            $file_fotokopi_ijazah_sttb = $request->file('fotokopi_ijazah_sttb');
            $extension_fotokopi_ijazah_sttb = $file_fotokopi_ijazah_sttb->getClientOriginalExtension();
            
            $filename_fotokopi_ijazah_sttb = time() . '_fotokopi_ijazah_sttb.' . $extension_fotokopi_ijazah_sttb;
            $path_fotokopi_ijazah_sttb = 'uploads/legalisir_fotokopi_ijazah_sttb/fotokopi_ijazah_sttb/';
            $file_fotokopi_ijazah_sttb->move($path_fotokopi_ijazah_sttb, $filename_fotokopi_ijazah_sttb);

            if(File::exists($legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb)){
                File::delete($legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb);
            }

            $legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb = $path_fotokopi_ijazah_sttb . $filename_fotokopi_ijazah_sttb;
        }

        $legalisir_fotokopi_ijazah_sttb->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'ijazah_sttb_asli' => $legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli ?? $legalisir_fotokopi_ijazah_sttb->getOriginal('ijazah_sttb_asli'),
            'fotokopi_ijazah_sttb' => $legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb ?? $legalisir_fotokopi_ijazah_sttb->getOriginal('fotokopi_ijazah_sttb'),
            'status' => $request->status,
        ]);

        return redirect('legalisir_fotokopi_ijazah_sttb')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $legalisir_fotokopi_ijazah_sttb = LegalisirFotokopiIjazahSTTB::findOrFail($id);
        if(File::exists($legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli)){
            File::delete($legalisir_fotokopi_ijazah_sttb->ijazah_sttb_asli);
        }
        if(File::exists($legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb)){
            File::delete($legalisir_fotokopi_ijazah_sttb->fotokopi_ijazah_sttb);
        }

        $legalisir_fotokopi_ijazah_sttb -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function export() 
    {
        $fillname = 'legalisir_fotokopi_ijazah_sttb.xlsx';
        return Excel::download(new LegalisirFotokopiIjazahSTTBExport, $fillname);
    }

    public function generatePDF()
    {
        $legalisir_fotokopi_ijazah_sttb = LegalisirFotokopiIjazahSTTB::get();
        $data = [
            'title' => 'Daftar Data Legalisir Fotokopi Ijazah/STTB',
            'date' => date('d/m/Y'),
            'legalisir_fotokopi_ijazah_sttb' => $legalisir_fotokopi_ijazah_sttb
        ];

        $pdf = PDF::loadView('legalisir_fotokopi_ijazah_sttb.pdf', $data);
        return $pdf->download('data.pdf');
    }

    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = LegalisirFotokopiIjazahSTTB::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
