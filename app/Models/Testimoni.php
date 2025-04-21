<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'foto',
        'testimoni',
        'status',
        'urutan'
    ];

    protected $casts = [
        'urutan' => 'integer'
    ];
}
