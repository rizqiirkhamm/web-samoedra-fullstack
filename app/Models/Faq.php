<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'urutan',
        'status'
    ];

    protected $casts = [
        'urutan' => 'integer'
    ];
}
