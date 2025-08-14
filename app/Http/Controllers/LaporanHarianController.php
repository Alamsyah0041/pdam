<?php

namespace App\Http\Controllers;


use App\Models\laporan_harian;
use App\Models\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $laporan = Operator::where('created_at', '>=', $today . ' 00:00:00')
            ->where('created_at', '<=', $today . ' 23:59:59')
            ->orderBy('id', 'desc') // urutkan terbaru dulu
            ->get();
            // dd($laporan);
        return view('pelaporan.laporanharian', compact('laporan'));

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
    public function show(laporan_harian $laporan_harian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(laporan_harian $laporan_harian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, laporan_harian $laporan_harian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(laporan_harian $laporan_harian)
    {
        //
    }
}
