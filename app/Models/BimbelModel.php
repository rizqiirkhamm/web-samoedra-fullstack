<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BimbelModel extends Model
{
    protected $table = 'bimbel';

    protected $fillable = [
        'name',
        'age',
        'phone',
        'bimbel_type',
        'service_type',
        'gender',
        'birth_place',
        'birth_date',
        'has_school_history',
        'school_name',
        'religion',
        'address',
        'child_order',
        'child_phone',
        'father_name',
        'father_age',
        'father_education',
        'father_occupation',
        'mother_name',
        'mother_age',
        'mother_education',
        'mother_occupation',
        'student_photo',
        'payment_proof',
        'start_date',
        'day',
        'total_meetings',
        'status',
        'need_socks'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'start_date' => 'date',
        'has_school_history' => 'boolean',
        'father_age' => 'integer',
        'mother_age' => 'integer',
        'child_order' => 'integer',
        'total_meetings' => 'integer',
        'age' => 'integer',
        'need_socks' => 'boolean'
    ];

    // Method untuk mendapatkan hari dari tanggal
    public static function getDayFromDate($date)
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $dayName = Carbon::parse($date)->format('l');
        return $days[$dayName];
    }

    // Tambahkan scope untuk filter
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Tambahkan scope untuk filter inactive
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Tambahkan accessor untuk status pertemuan
    public function getCompletedMeetingsAttribute()
    {
        // Implementasi sesuai kebutuhan
        return 0; // Sementara return 0
    }

    public function getRemainingMeetingsAttribute()
    {
        return $this->total_meetings - $this->completed_meetings;
    }

    // Tambahkan method untuk mengupdate status berdasarkan tanggal
    public static function updateStatusBasedOnDate()
    {
        $today = Carbon::now()->startOfDay();

        // Update status menjadi active untuk bimbel yang tanggal mulainya sudah sampai
        self::where('status', 'inactive')
            ->where('start_date', '<=', $today)
            ->update(['status' => 'active']);
    }

    // Tambahkan method untuk mendapatkan single record dan semua record
    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord(){
        return self::get();
    }
}
