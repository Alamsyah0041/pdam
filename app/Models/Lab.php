<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $table = 'lab';
    protected $fillable = [
        'ntu_air_bersih',
        'ntu_air_baku',
        'sisa_chlor',
        'ph'
       
    ];
}
