<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKerja;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SuratKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratkerjas = DB::table('view_surat_kerja')->get();
        return view('suratkerja.index', compact('suratkerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the current date
        $currentDate = date('Ymd');

        // Fetch the latest Surat Kerja for the current date
        $lastSuratKerja = SuratKerja::where('nomor_surat', 'like', 'SK-' . $currentDate . '-%')->latest('nomor_surat')->first();

        // Extract the incrementing number from the Surat Kerja number and increment it
        $suratKerjaNumber = $lastSuratKerja ? (int) substr($lastSuratKerja->nomor_surat, -3) + 1 : 1;

        // Initialize the Surat Kerja code with the current date and the incremented number
        $suratKerjaCode = 'SK-' . $currentDate . '-' . str_pad($suratKerjaNumber, 3, '0', STR_PAD_LEFT);

        // Fetch the "panwascam" role
        $panwascamRole = Role::where('name', 'panwascam')->first();

        // Fetch users with the "panwascam" role if the role exists
        $panwascamUsers = $panwascamRole ? $panwascamRole->users : null;

        return view('suratkerja.create', compact('suratKerjaCode', 'panwascamUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat_kerja' => 'required',
            'user_id' => 'required',
        ],
        [
            'nomor_surat_kerja.required' => 'Nomor Surat wajib diisi',
            'user_id.required' => 'Tanggal Surat wajib diisi',
    ]);

        $suratkerja = new SuratKerja;
        $suratkerja->nomor_surat = $request->nomor_surat_kerja;
        
        //fatch userinput (bawaslu kota)
        $suratkerja->bawaslu_kota_id = Auth::user()->id;

        $suratkerja->panwascam_id = $request->user_id;
        
        $suratkerja->save();
        return redirect()->route('suratkerja.index')->with('success', 'Surat Kerja berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratkerja = SuratKerja::findOrFail($id);
        $suratkerja->delete();
        return redirect()->route('suratkerja.index')->with('success', 'Surat Kerja berhasil dihapus');
    }
}
