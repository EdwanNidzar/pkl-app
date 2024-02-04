<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPelanggaran;

class JenisPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenispelanggaran = JenisPelanggaran::orderBy('id', 'ASC')->get();
        return view('jenispelanggaran.index', compact('jenispelanggaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenispelanggaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pelanggaran' => 'required',
        ],[
            'jenis_pelanggaran.required' => 'Jenis pelanggaran harus diisi',
        ]);

        $jenispelanggaran = new JenisPelanggaran;
        $jenispelanggaran->jenis_pelanggaran = $request->jenis_pelanggaran;
        $jenispelanggaran->save();

        return redirect()->route('jenispelanggaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = JenisPelanggaran::where('id', $id)->first();
        return view('jenispelanggaran.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = JenisPelanggaran::where('id', $id)->first();
        return view('jenispelanggaran.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenispelanggaran = JenisPelanggaran::findOrFail($id);

        $request->validate([
            'jenis_pelanggaran' => 'required',
        ],[
            'jenis_pelanggaran.required' => 'Jenis pelanggaran harus diisi',
        ]);

        $jenispelanggaran->jenis_pelanggaran = $request->jenis_pelanggaran;
        $jenispelanggaran->update();

        return redirect()->route('jenispelanggaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenispelanggaran = JenisPelanggaran::findOrFail($id);
        $jenispelanggaran->delete();

        return redirect()->route('jenispelanggaran.index');
    }
}