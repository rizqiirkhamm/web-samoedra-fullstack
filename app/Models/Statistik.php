<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    protected $table = 'statistiks';

    protected $fillable = [
        'daycare',
        'daycare_title',
        'daycare_description',
        'bermain',
        'bermain_title',
        'bermain_description',
        'bimbel',
        'bimbel_title',
        'bimbel_description',
        'stimulasi',
        'stimulasi_title',
        'stimulasi_description',
        'event',
        'event_title',
        'event_description',
        'status'
    ];

    protected $casts = [
        'daycare' => 'integer',
        'bermain' => 'integer',
        'bimbel' => 'integer',
        'stimulasi' => 'integer',
        'event' => 'integer'
    ];
}
