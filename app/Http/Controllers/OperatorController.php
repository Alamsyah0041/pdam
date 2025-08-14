<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $operator = operator::all();
         $operator = Operator::orderBy('id', 'desc')->get(); 
        // dd($operator[0]->id);
            
        
        // dd(Auth()->user());
        return view('Operator.operator', compact('operator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelaporan.operator.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    private function sendFonnteMessage($target, $message, $imageUrl = null)
    {
        $data = [
            'target'  => '085346934200', // number from parameter
            'message' => $message
        ];

        if ($imageUrl) {
            $data['url'] = $imageUrl; // public image URL
        }

        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', $data);

        return $response->json();
    }

    /**
     * Store a newly created operator report and send via WhatsApp
     */
public function store(Request $request)
{
    $request->validate([
        'Debit_air'        => 'required|numeric',
        'tinggi_reservoard'=> 'required|numeric',
        'status_pompa'     => 'required|string',
        'frekuensi_pompa'  => 'required|numeric',
        'pompa'            => 'required|array|min:1',
        'pompa.*'          => 'string',
        'keluhan'          => 'nullable|string',
        'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $userId = auth()->check() ? auth()->user()->id : 'Guest';

    // Save to DB
    $operator = Operator::create([
        'nama'             => $userId,
        'Debit_air'        => $request->Debit_air,
        'tinggi_reservoard'=> $request->tinggi_reservoard,
        'status_pompa'     => $request->status_pompa,
        'frekuensi_pompa'  => $request->frekuensi_pompa,
        'pompa'            => implode(',', $request->pompa),
        'keluhan'          => $request->keluhan,
        'image'            => $request->file('image') 
                                ? $request->file('image')->store('image', 'public') 
                                : null,
    ]);

    // Build WhatsApp message
    $message = "🚰 Laporan Operator Baru\n"
             . "Nama: {$userId}\n"
             . "Debit Air: {$request->Debit_air}\n"
             . "Tinggi Reservoir: {$request->tinggi_reservoard}\n"
             . "Status Pompa: {$request->status_pompa}\n"
             . "Frekuensi Pompa: {$request->frekuensi_pompa}\n"
             . "Pompa Aktif: " . implode(',', $request->pompa) . "\n"
             . "Keluhan: {$request->keluhan}";

    // Generate public image URL if exists
    // Send WhatsApp message via Fonnte
    $this->sendFonnteMessage(
        env('FALLBACK_FONNTE_RECIPIENT'), 
        $message,
    );

    return redirect()->route('Operator.index')
        ->with('success', 'Data berhasil disimpan dan pesan WhatsApp terkirim!');
}



public function edit($id)
{
    $operator = Operator::with('user')->findOrFail($id);
    
    return response()->json([
        'id' => $operator->id,
        'nama' => $operator->user->name,
        'id_op' => $operator->nama,
        'Debit_air' => $operator->Debit_air,
        'tinggi_reservoard' => $operator->tinggi_reservoard,
        'status_pompa' => $operator->status_pompa,
        'frekuensi_pompa' => $operator->frekuensi_pompa,
        'pompa' => $operator->pompa,
        'keluhan' => $operator->keluhan,
        'image' => $operator->image ? asset('storage/' . $operator->image) : null
    ]);
}


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        // 'nama'             => 'required|string|max:255',
        'Debit_air'        => 'required|numeric',
        'tinggi_reservoard'=> 'required|numeric',
        'status_pompa'     => 'required|string',
        'frekuensi_pompa'  => 'required|numeric',
        'pompa'            => 'required|array|min:1',
        'pompa.*'          => 'string',
        'keluhan'          => 'nullable|string',
        'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $operator = Operator::findOrFail($id);

    $operator->update([
        'nama'              => auth()->user()->id,
        'Debit_air'         => $request->Debit_air,
        'tinggi_reservoard' => $request->tinggi_reservoard,
        'status_pompa'      => $request->status_pompa,
        'frekuensi_pompa'   => $request->frekuensi_pompa,
        'pompa' => implode(',', $request->pompa),
        'keluhan'           => $request->keluhan,
        'image'             => $request->file('image') 
                                ? $request->file('image')->store('image', 'public') 
                                : $operator->image,
    ]);

    return redirect()->route('Operator.index')->with('success', 'Data berhasil diperbarui!');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    {
         $operator = Operator::findOrFail($id);
    $operator->delete();

    return redirect()->route('Operator.index')->with('success', 'Data berhasil dihapus!');
}
}
