<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RepairActivity;

class RepairActivitySeeder extends Seeder
{
    public function run()
    {
        $repairActivities = [
            [
                'report_id' => 1,
                'assigned_to' => 2,
                'start_date' => now(),
                'end_date' => now()->addDays(2),
                'remarks' => 'Perbaikan panel listrik sedang dilakukan.',
            ],
            [
                'report_id' => 2,
                'assigned_to' => 1,
                'start_date' => now(),
                'end_date' => now()->addDays(1),
                'remarks' => 'Menunggu penggantian pipa.',
            ],
        ];

        foreach ($repairActivities as $activity) {
            RepairActivity::create($activity);
        }
    }
}
