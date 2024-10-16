<?php

namespace Database\Seeders;

use App\Models\Ultg;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UltgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path() . "/json/ultg.json";
        $json = json_decode(file_get_contents($path), true);
        $now = now();
        $json = array_map(function ($data) use ($now) {
            $data['created_at'] = $now;
            $data['updated_at'] = $now;
            return $data;
        }, $json);
        Ultg::insert($json);
    }
}
