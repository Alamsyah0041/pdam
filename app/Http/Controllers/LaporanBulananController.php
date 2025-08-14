<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use Carbon\Carbon;
class LaporanBulananController extends Controller
{
    public function index()
    {
        $thismonth = Carbon::now()->format('Y-m');
        // dd($thismonth);
        $laporan = Operator::where('created_at', '>=', $thismonth . '-01 00:00:00')
            ->where('created_at', '<=', $thismonth . '-31 23:59:59')
            ->orderBy('id', 'desc') // urutkan terbaru dulu
            ->get();
            // dd($laporan);
        return view('pelaporan.laporanbulanan', compact('laporan'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Operator $laporan_harian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Operator::findOrFail($id);
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'Debit_air'         => 'required|numeric',
            'tinggi_reservoard' => 'required|numeric',
            'status_pompa'      => 'required|string',
            'frekuensi_pompa'   => 'required|numeric',
            'pompa'             => 'required|string',
            'keluhan'           => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $operator = Operator::findOrFail($id);

        $operator->update([
            'nama'             => $request->input('nama'),
            'Debit_air'         => $request->input('Debit_air'),
            'tinggi_reservoard' => $request->input('tinggi_reservoard'),
            'status_pompa'      => $request->input('status_pompa'),
            'frekuensi_pompa'   => $request->input('frekuensi_pompa'),
            'pompa'             => $request->input('pompa'),
            'keluhan'           => $request->input('keluhan'),
            'image'             => $request->file('image') ? $request->file('image')->store('image', 'public') : $operator->image,
        ]);

        return redirect()->route('Operator.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operator $laporan_harian)
    {
        //
    }
}

