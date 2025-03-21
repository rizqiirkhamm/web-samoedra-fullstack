<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\BimbelModel;
use App\Models\BermainModel;
use App\Models\JournalModel;
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

        // Data Dummy untuk Daycare (sementara)
        $totalDaycare = 150; // Data dummy
        $daycareGrowth = 3.5; // Data dummy

        // Data Real untuk Bimbel
        $totalBimbel = BimbelModel::count();
        $lastWeekBimbel = BimbelModel::where('created_at', '>=', now()->subWeek())->count();
        $previousWeekBimbel = BimbelModel::whereBetween('created_at', [
            now()->subWeeks(2),
            now()->subWeek()
        ])->count();
        $bimbelGrowth = $previousWeekBimbel > 0
            ? (($lastWeekBimbel - $previousWeekBimbel) / $previousWeekBimbel) * 100
            : 0;

        // Data Real untuk Bermain
        $totalBermain = BermainModel::count();
        $lastWeekBermain = BermainModel::where('created_at', '>=', now()->subWeek())->count();
        $previousWeekBermain = BermainModel::whereBetween('created_at', [
            now()->subWeeks(2),
            now()->subWeek()
        ])->count();
        $bermainGrowth = $previousWeekBermain > 0
            ? (($lastWeekBermain - $previousWeekBermain) / $previousWeekBermain) * 100
            : 0;

        // Data untuk Chart Revenue (6 bulan terakhir)
        $revenueLabels = [];
        $revenueData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $revenueLabels[] = $month->format('M');

            // Hitung total pendapatan dari Bimbel dan Bermain
            $monthRevenue = 0;

            // Asumsi harga Bimbel 50.000
            $bimbelCount = BimbelModel::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            $monthRevenue += $bimbelCount * 50000;

            // Hitung pendapatan Bermain berdasarkan durasi
            $bermainRevenue = BermainModel::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->get()
                ->sum(function($bermain) {
                    // Harga berdasarkan durasi
                    $prices = [
                        1 => 15000,  // 1 jam = 15.000
                        2 => 25000,  // 2 jam = 25.000
                        3 => 50000   // 3 jam = 50.000
                    ];
                    return $prices[$bermain->duration] ?? 0;
                });

            $monthRevenue += $bermainRevenue;
            $revenueData[] = $monthRevenue;
        }

        // Hitung persentase kontribusi setiap layanan
        $totalRevenue = array_sum($revenueData);
        $daycarePercentage = 13; // Data dummy

        // Hitung persentase real untuk Bimbel dan Bermain
        $bimbelRevenue = BimbelModel::count() * 50000; // Asumsi harga tetap 50.000
        $bimbelPercentage = $totalRevenue > 0 ? ($bimbelRevenue / $totalRevenue) * 100 : 0;

        $bermainPercentage = $totalRevenue > 0 ? (100 - $daycarePercentage - $bimbelPercentage) : 0;

        // Data Tren (10 hari terakhir)
        $trendDays = [];
        $bimbelTrend = [];
        $bermainTrend = [];

        for ($i = 9; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $trendDays[] = now()->subDays($i)->format('d/m');

            $bimbelTrend[] = BimbelModel::whereDate('created_at', $date)->count();
            $bermainTrend[] = BermainModel::whereDate('created_at', $date)->count();
        }

        // Data Journal terbaru
        $recentJournals = JournalModel::with('bimbel')
            ->latest()
            ->take(5)
            ->get();

        // Data Users terbaru
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        return view('users.dashboard', compact(
            'getRecord',
            'totalDaycare', 'totalBimbel', 'totalBermain',
            'daycareGrowth', 'bimbelGrowth', 'bermainGrowth',
            'revenueLabels', 'revenueData',
            'totalRevenue', 'daycarePercentage', 'bimbelPercentage', 'bermainPercentage',
            'recentUsers', 'recentJournals',
            'trendDays', 'bimbelTrend', 'bermainTrend'
        ));
    }
}
