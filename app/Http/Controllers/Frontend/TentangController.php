<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    public function index(){
        // Mendapatkan data tentang dari file JSON
        $tentangData = $this->getTentangData();

        // Mendapatkan data organisasi dari file JSON
        $organisasiData = $this->getOrganisasiData();

        return view('tentang', [
            'tentangData' => $tentangData,
            'organisasiData' => $organisasiData
        ]);
    }

    // Mendapatkan data tentang dari file JSON
    private function getTentangData()
    {
        $jsonPath = 'tentang/data.json';
        $defaultData = [
            'sambutan_lembaga' => 'SAMOEDRA berdiri murni dibawah Lembaga swasta tidak dibawah Kementerian Tertentu sehingga memiliki keunikan tersendiri dalam pelayanan anak karena tidak ada intervensi dari tekanan Kurikulum tertentu. Sesuai koncep dan motonya, "belajar dan main suka-suka"<br><br>"Kami hadir untuk memberikan pengembangan tumbuh kembang anak yang baik, luar Biasa, istimewa. Kami hadir merepresentasikan pecan orang tua dalam mendidik anak.""',
            'tempat_bermain' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. At, animi deserunt unde architecto, natus asperiores numquam expedita assumenda quidem quis, suscipit facere perspiciatis porro.',
            'konsep_pendidikan' => 'Kurikulum Adaptif: Dirancang untuk memenuhi kebutuhan anak dengan pendekatan sensorik dan stimulasi motorik, mengusung konsep "Bebas dan Merdeka Belajar" yang fleksibel dan berkembang sesuai ilmu pengetahuan.',
            'filosofi' => 'Samoedra melambangkan kebebasan dan keluasaan hidup, seperti samudra yang tak terbatas. ORCA merepresentasikan kecerdasan paus dan lumba-lumba, mengajarkan anak belajar dengan bebas dan pintar.',
            'sejarah' => 'CV Konci, berdiri sejak 2017, bergerak di bidang pendidikan tinggi dan kemitraan. Resmi terdaftar sebagai Penanaman Modal Dalam Negeri (PMDN).',
            'image_sambutan' => 'images/assets/img1.png'
        ];

        if (Storage::disk('public')->exists($jsonPath)) {
            $jsonData = Storage::disk('public')->get($jsonPath);
            $data = json_decode($jsonData, true);

            // Gabungkan dengan data default untuk memastikan semua field ada
            return array_merge($defaultData, $data);
        }

        return $defaultData;
    }

    // Mendapatkan data organisasi dari file JSON
    private function getOrganisasiData()
    {
        $jsonPath = 'tentang/organisasi.json';
        $defaultData = [
            'manajemen' => [
                [
                    'id' => 'direktur',
                    'nama' => 'Mr Hakim',
                    'jabatan' => 'Direktur',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'manager',
                    'nama' => 'Miss Rina',
                    'jabatan' => 'Manager Operasional',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ]
            ],
            'guru' => [
                [
                    'id' => 'guru1',
                    'nama' => 'Mr. Karim',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'guru2',
                    'nama' => 'Mr. Dimas',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'guru3',
                    'nama' => 'Mr. Andi',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'guru4',
                    'nama' => 'Miss Anna',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ]
            ]
        ];

        if (Storage::disk('public')->exists($jsonPath)) {
            $jsonData = Storage::disk('public')->get($jsonPath);
            $data = json_decode($jsonData, true);

            // Gabungkan dengan data default untuk memastikan semua field ada
            return $data ?: $defaultData;
        }

        return $defaultData;
    }
}
