<?php

namespace App\Http\Controllers;
use App\Models\Lab;
use Carbon\Carbon;

use Illuminate\Http\Request;

class LaporanBulananLabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $thismonth = Carbon::now()->format('Y-m');
        // dd($thismonth);
        $lab = Lab::where('created_at', '>=', $thismonth . '-01 00:00:00')
            ->where('created_at', '<=', $thismonth . '-31 23:59:59')
            ->orderBy('id', 'desc') // urutkan terbaru dulu
            ->get();
            // dd($laporan);
        return view('pelaporan.laporanbulananlab', compact('lab'));

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
