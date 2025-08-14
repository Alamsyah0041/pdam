<?php

namespace App\Http\Controllers;

use App\Models\LokasiInstalasi;
use Illuminate\Http\Request;

class LokasiInstalasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = LokasiInstalasi::all();
        $defaultLocation = $lokasi->count() > 0 
            ? [$lokasi->first()->latitude, $lokasi->first()->longitude]
            : [-0.5048, 117.1537]; 
        
        return view('pelaporan.lokasi', compact('lokasi', 'defaultLocation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_instalasi' => 'required|string|max:255',
            'nama_jalan' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'keterangan' => 'nullable|string',
        ]);

        LokasiInstalasi::create($validated);

        return back()->with('success', 'Lokasi berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LokasiInstalasi $lokasiInstalasi)
    {
        $lokasiInstalasi->delete();
        return back()->with('success', 'Lokasi berhasil dihapus.');
    }
}