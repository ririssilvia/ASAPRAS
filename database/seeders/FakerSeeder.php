<?php

namespace Database\Seeders;

use App\Models\Logdataesp;
use App\Models\Trafo;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $trafos = Trafo::all();

        // Count dummy
        $arrayEsp = [];
        $countEsp = 30; // per trafo

        foreach ($trafos as $trafo) {
            $prevEsp = null;
            for ($e = 0; $e < $countEsp; $e++) {
                $incrementDate = now()->subMinutes(5 * $e);
                $data = [
                    'code_trafo' => $trafo->code_trafo,
                    'suhu_daerah' => $faker->randomFloat(1, 20, 30),
                    'tmp_oil_ind' => $faker->randomFloat(1, 20, 30),
                    'tmp_hv_ind' => $faker->randomFloat(1, 20, 30),
                    'tmp_lv_ind' => $faker->randomFloat(1, 20, 30),
                    'position_tap' => $faker->randomDigitNotNull(),
                    'trans_cool' => $faker->randomElement([0, 1]),
                    'trans_fan' => $faker->randomElement([0, 1]),
                    'trans_mcb' => $faker->randomElement([0, 1]),
                    'local' => $faker->randomElement([0, 1]),
                    'pressure' => $faker->randomElement([0, 1]),
                    'oil_tmp_alaram' => $faker->randomElement([0, 1]),
                    'oil_tmp_trip' => $faker->randomElement([0, 1]),
                    'oil_tmp_min' => $faker->randomElement([0, 1]),
                    'oil_tmp_max' => $faker->randomElement([0, 1]),
                    'hv_tmp' => $faker->randomElement([0, 1]),
                    'lv_tmp' => $faker->randomElement([0, 1]),
                    'buch_alarm' => $faker->randomElement([0, 1]),
                    'sudden_presure' => $faker->randomElement([0, 1]),
                    'fire_detection' => $faker->randomElement([0, 1]),
                    'jasen_Trip' => $faker->randomElement([0, 1]),
                    'created_at' => $incrementDate,
                    'updated_at' => $incrementDate
                ];

                $lastUpdateColumns = [
                    'trans_cool_last_updated',
                    'trans_fan_last_updated',
                    'trans_mcb_last_updated',
                    'local_last_updated',
                    'pressure_last_updated',
                    'oil_tmp_alaram_last_updated',
                    'oil_tmp_trip_last_updated',
                    'oil_tmp_min_last_updated',
                    'oil_tmp_max_last_updated',
                    'hv_tmp_last_updated',
                    'lv_tmp_last_updated',
                    'buch_alarm_last_updated',
                    'sudden_presure_last_updated',
                    'fire_detection_last_updated',
                    'jasen_Trip_last_updated'
                ];

                if (!$prevEsp) {
                    foreach ($lastUpdateColumns as $lastUpdateColumn) {
                        $data[$lastUpdateColumn] = $incrementDate;
                    }
                    $data['tmp_oil_ind_average'] = $data['tmp_oil_ind'];
                    $data['tmp_hv_ind_average'] = $data['tmp_hv_ind'];
                    $data['tmp_lv_ind_average'] = $data['tmp_lv_ind'];
                } else {
                    foreach ($lastUpdateColumns as $lastUpdateColumn) {
                        $column = str_replace('_last_updated', '', $lastUpdateColumn);
                        $data[$lastUpdateColumn] = ($prevEsp[$column] == $data[$column]) ? $prevEsp[$lastUpdateColumn] : $incrementDate;
                    }
                    $data['tmp_oil_ind_average'] = round(($data['tmp_oil_ind'] + $prevEsp['tmp_oil_ind_average']) / 2, 1);
                    $data['tmp_hv_ind_average'] = round(($data['tmp_hv_ind'] + $prevEsp['tmp_hv_ind_average']) / 2, 1);
                    $data['tmp_lv_ind_average'] = round(($data['tmp_lv_ind'] + $prevEsp['tmp_lv_ind_average']) / 2, 1);
                }

                array_push($arrayEsp, $data);
                $prevEsp = $data;
            }
        }

        $chunks = array_chunk($arrayEsp, 1000);
        $this->command->withProgressBar($chunks, function($chunk) {
            Logdataesp::insert($chunk);
        });
    }
}
