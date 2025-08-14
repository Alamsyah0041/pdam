<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan_harian extends Model
{
    use HasFactory;

    protected $table = 'laporanharian';
    protected $fillable = [
        'nama',
        'debit_air',
        'tinggi_reservoard',
        'status_pompa',
        'frekuensi_pompa',
        'pompa',
        'keluhan',
        'foto'
    ];
}
