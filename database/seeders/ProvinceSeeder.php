<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::create([
            'name' => 'Bukidnon',
            // 'code'=>'101300000',
            // 'region_code'=>'100000000',
            // 'psgc_code'=>'1001300000',
            // 'island_name' => 'Mindanao',
        ]);
    }
}

//province
// "code": "101300000",
// "name": "Bukidnon",
// "regionCode": "100000000",
// "islandGroupCode": "mindanao",
// "psgc10DigitCode": "1001300000"
