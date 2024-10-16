<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        $facilities = [
            [
                'name' => 'Panel Listrik Utama',
                'category' => 'listrik',
                'location' => 'Gedung A',
                'status' => 'aktif',
            ],
            [
                'name' => 'Pipa Saluran Air',
                'category' => 'plumbing',
                'location' => 'Gedung B',
                'status' => 'aktif',
            ],
            [
                'name' => 'AC Ruang Rapat',
                'category' => 'AC',
                'location' => 'Lantai 1',
                'status' => 'non_aktif',
            ],
            [
                'name' => 'Lampu Jalan',
                'category' => 'infrastruktur_lain',
                'location' => 'Area Parkir',
                'status' => 'aktif',
            ],
            [
                'name' => 'Genset Cadangan',
                'category' => 'listrik',
                'location' => 'Gedung C',
                'status' => 'non_aktif',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
