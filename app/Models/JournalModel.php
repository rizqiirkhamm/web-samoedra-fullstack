<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalModel extends Model
{
    protected $table = 'journal';

    protected $fillable = [
        'bimbel_id',
        'tanggal',
        'nama_guru',
        'pelajaran',
        'pembahasan',
        'pertemuan_ke',
        'periode_ke',
        'created_by'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'pertemuan_ke' => 'integer',
        'periode_ke' => 'integer'
    ];

    public function bimbel()
    {
        return $this->belongsTo(BimbelModel::class, 'bimbel_id');
    }
}
