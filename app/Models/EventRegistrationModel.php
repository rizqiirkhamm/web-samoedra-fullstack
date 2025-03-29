<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistrationModel extends Model
{
    protected $table = 'event_registrations';

    protected $fillable = [
        'event_id',
        'name',
        'age',
        'phone',
        'parent_name',
        'address',
        'social_media',
        'payment_proof',
        'need_socks',
        'source_info'
    ];

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }
}
