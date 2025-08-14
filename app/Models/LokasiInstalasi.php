<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiInstalasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi_instalasi';
   protected $fillable = [
    'nama_instalasi',
    'nama_jalan',
    'latitude',
    'longitude',
    'keterangan',
];

}
