<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\BimbelModel;
use App\Models\BermainModel;
use App\Models\JournalModel;
use App\Models\DaycareRegistrationModel;
use App\Models\StimulasiModel;
use App\Models\EventModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get recent users for table
        $getRecord = User::orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function($user) {
                $user->role_name = $user->role->name ?? 'No Role';
                return $user;
            });

        // Hitung total layanan
        $totalDaycare = DaycareRegistrationModel::count();
        $totalBimbel = BimbelModel::count();
        $totalBermain = BermainModel::count();
        $totalStimulasi = StimulasiModel::count();
        $totalEvent = EventModel::count();

        // Weekly Join Rates per Service
        $startOfWeek = now()->startOfWeek();
        $weeklyData = [
            'labels' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            'daycare' => [],
            'bimbel' => [],
            'bermain' => [],
            'stimulasi' => [],
            'event' => []
        ];

        for ($i = 0; $i < 7; $i++) {
            $currentDate = $startOfWeek->copy()->addDays($i);

            // Hitung jumlah pendaftar per layanan per hari
            $weeklyData['daycare'][] = DaycareRegistrationModel::whereDate('created_at', $currentDate)->count();
            $weeklyData['bimbel'][] = BimbelModel::whereDate('created_at', $currentDate)->count();
            $weeklyData['bermain'][] = BermainModel::whereDate('created_at', $currentDate)->count();
            $weeklyData['stimulasi'][] = StimulasiModel::whereDate('created_at', $currentDate)->count();
            $weeklyData['event'][] = EventModel::whereDate('created_at', $currentDate)->count();
        }

        return view('users.dashboard', compact(
            'getRecord',
            'totalDaycare',
            'totalBimbel',
            'totalBermain',
            'totalStimulasi',
            'totalEvent',
            'weeklyData'
        ));
    }
}
