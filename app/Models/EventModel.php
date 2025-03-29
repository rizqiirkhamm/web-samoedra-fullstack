<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name',
        'description',
        'event_date',
        'status'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'price' => 'decimal:2'
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistrationModel::class, 'event_id');
    }
}
