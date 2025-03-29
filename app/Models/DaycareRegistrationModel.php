<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaycareRegistrationModel extends Model
{
    protected $table = 'daycare_registrations';

    protected $fillable = [
        'name', 'age', 'phone', 'height', 'weight', 'daycare_type',
        'gender', 'birth_place', 'birth_date', 'address',
        'child_phone', 'child_order', 'religion',
        'father_name', 'father_age', 'father_education', 'father_occupation',
        'mother_name', 'mother_age', 'mother_education', 'mother_occupation',
        'student_photo', 'payment_proof', 'status', 'need_socks'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}