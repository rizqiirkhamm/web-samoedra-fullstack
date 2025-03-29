<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StimulasiModel extends Model
{
    protected $table = 'stimulasi';

    protected $fillable = [
        'name', 'age', 'phone', 'height', 'weight', 'gender',
        'birth_place', 'birth_date', 'address', 'child_phone', 'religion',
        'father_name', 'father_age', 'father_education', 'father_occupation',
        'mother_name', 'mother_age', 'mother_education', 'mother_occupation',
        'student_photo', 'payment_proof', 'status', 'need_socks',
        'child_order'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'need_socks' => 'boolean'
    ];
}
