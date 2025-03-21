<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BermainModel extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'bermain';

    // Specify fillable fields
    protected $fillable = [
        'name',
        'age',
        'phone',
        'duration',
        'start_datetime',
        'end_datetime',
        'day',
        'payment_proof',
        'status',
        'remaining_time',
        'need_socks'
    ];

    // Cast attributes
    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'need_socks' => 'boolean',
    ];
}
