<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKerja;

class SuratKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastSuratKerja = SuratKerja::latest()->first();
        $suratKerjaNumber = $lastSuratKerja ? $lastSuratKerja->number + 1 : 1;

        // Get the current date
        $currentDate = date('Ymd'); // This will give you the date in the format 'YYYYMMDD'. You can change the format as per your needs.

        // Initialize the Surat Kerja code with the current date
        $suratKerjaCode = 'SK-' . $currentDate . '-' . str_pad($suratKerjaNumber, 3, '0', STR_PAD_LEFT);

        // Your code to create SuratKerja goes here

        return "<h1>$suratKerjaCode</h1>";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
