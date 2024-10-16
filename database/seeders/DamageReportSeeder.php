<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DamageReport;

class DamageReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DamageReport::create([
            'facility_id' => 1, // Sesuaikan dengan ID fasilitas yang ada di tabel facilities
            'reported_by' => 1, // Sesuaikan dengan ID user yang ada di tabel users
            'description' => 'Panel listrik mengalami kerusakan.',
            'image_url' => 'images/damage_reports/panel_listrik.jpg',
            'status' => 'laporan_diterima', // Status bisa 'laporan_diterima', 'dalam_perbaikan', atau 'selesai'
        ]);

        DamageReport::create([
            'facility_id' => 1,
            'reported_by' => 1,
            'description' => 'Pipa bocor di area parkir.',
            'image_url' => 'images/damage_reports/pipa_bocor.jpg',
            'status' => 'dalam_perbaikan',
        ]);

        DamageReport::create([
            'facility_id' => 2, // Pastikan ID ini sesuai dengan fasilitas yang ada
            'reported_by' => 2, // Pastikan ID ini sesuai dengan user yang ada
            'description' => 'AC tidak dingin.',
            'image_url' => 'images/damage_reports/ac_tidak_dingin.jpg',
            'status' => 'selesai',
        ]);
    }
}
