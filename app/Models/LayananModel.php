<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananModel extends Model
{
    // Karena tidak ada database, kita bisa membuat method static untuk mendapatkan list layanan
    static public function getRecord()
    {
        // Return array of available services
        return [
            [
                'id' => 'bermain',
                'nama_layanan' => 'Bermain',
                'slug' => 'bermain'
            ],
            [
                'id' => 'bimbel',
                'nama_layanan' => 'Bimbel',
                'slug' => 'bimbel'
            ],
            [
                'id' => 'event',
                'nama_layanan' => 'Event',
                'slug' => 'event'
            ]
        ];
    }
}
