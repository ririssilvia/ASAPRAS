<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\DamageReport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah fasilitas
        $totalFacilities = Facility::count();
        $activeFacilities = Facility::where('status', 'aktif')->count();
        $inactiveFacilities = Facility::where('status', 'non aktif')->count();

        // Menghitung jumlah laporan kerusakan berdasarkan status
        $totalReports = DamageReport::count();
        $reportsReceived = DamageReport::where('status', 'laporan_diterima')->count();
        $reportsInProgress = DamageReport::where('status', 'dalam_perbaikan')->count();
        $reportsCompleted = DamageReport::where('status', 'selesai')->count(); // Hitung laporan yang selesai

        return view('dashboard.index', compact(
            'totalFacilities',
            'activeFacilities',
            'inactiveFacilities',
            'totalReports',
            'reportsReceived',
            'reportsInProgress',
            'reportsCompleted' // Tambahkan ke data yang dikirim ke view
        ));
    }
}
