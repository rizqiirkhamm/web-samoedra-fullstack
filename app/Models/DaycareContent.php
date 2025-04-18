<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaycareContent extends Model
{
    use HasFactory;

    protected $table = 'daycare_contents';

    protected $fillable = [
        'banner_type',
        'banner_image',
        'banner_video',
        'kelebihan_daycare',
        'about_daycare_title',
        'about_daycare_description',
        'about_daycare_details',
        'about_caregiver_title',
        'about_caregiver_description',
        'program_description',
        'program_image',
        'program_points',
        'facilities',
        'pricelist',
        'activities',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'about_daycare_details' => 'array',
        'program_points' => 'array',
        'facilities' => 'array',
        'pricelist' => 'array',
        'activities' => 'array',
    ];
}
