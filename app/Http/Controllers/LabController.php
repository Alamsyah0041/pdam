<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lab = Lab::all();
        return view('Lab.lab', compact('lab'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelaporan.lab.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'ntu_air_bersih' => 'required|numeric',
            'ntu_air_baku'     => 'required|numeric',
            'sisa_chlor'       => 'required|numeric',
            'ph'               => 'required|numeric',
        ]);

        $lab = Lab::create([
            'ntu_air_bersih' => $request->ntu_air_bersih,
            'ntu_air_baku'     => $request->ntu_air_baku,
            'sisa_chlor'       => $request->sisa_chlor,
            'ph'               => $request->ph,
        ]);

        return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $lab]);

      
    }

    /**
     * Display the specified resource.
     */
    public function show(Lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lab = Lab::findOrFail($id);
        return response()->json([
            'id' => $lab->id,
            'ntu_air_bersih' => $lab->ntu_air_bersih,
            'ntu_air_baku' => $lab->ntu_air_baku,
            'sisa_chlor' => $lab->sisa_chlor,
            'ph' => $lab->ph,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'ntu_air_bersih' => 'required|numeric',
            'ntu_air_baku'     => 'required|numeric',
            'sisa_chlor'       => 'required|numeric',
            'ph'               => 'required|numeric',
        ]);

        $lab = Lab::findOrFail($id);

        $lab->update([
            'ntu_air_bersih' => $request->ntu_air_bersih,
            'ntu_air_baku'     => $request->ntu_air_baku,
            'sisa_chlor'       => $request->sisa_chlor,
            'ph'               => $request->ph,
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $lab]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);
        $lab->delete();

        // return response()->json(['message' => 'Data berhasil dihapus']);
        return redirect()->route('lab.index')->with('success', 'Data berhasil dihapus');
    }
}
