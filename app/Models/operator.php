<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $table  = 'operator';
    protected $casts = [
    'pompa' => 'array',
];

    protected $fillable = ['nama','Debit_air','tinggi_reservoard','status_pompa','frekuensi_pompa','pompa','keluhan','image'];

    public function getPompaArrayAttribute()
    {
        return explode(',', $this->pompa);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'nama', 'id');
    }
}