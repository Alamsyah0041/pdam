<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\Lab;

class DashboardController extends Controller
{
    public function index()
    {
        $dataOperatorTerakhir = Operator::latest()->first(); // data terakhir Operator
        $dataLabTerakhir = Lab::latest()->first(); // data terakhir Lab
        // dd($dataOperatorTerakhir->user->name);            // data terakhir Lab
        // dd($dataLabTerakhir);
        // dd($dataOperatorTerakhir, $dataLabTerakhir); // Debugging output

        // dd($dataOperatorTerakhir, $dataLabTerakhir); // Uncomment this line to debug
        return view('pelaporan.index', compact('dataOperatorTerakhir', 'dataLabTerakhir'));
    }
}
