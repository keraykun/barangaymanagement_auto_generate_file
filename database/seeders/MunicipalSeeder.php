<?php

namespace Database\Seeders;

use App\Models\Municipal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Municipal::create([
            'province_id'=>'1',
            'name' => 'Maramag',
            // 'old_name' => '',
            // 'is_municipal'=>true,
            // 'code'=>'101315000',
            // 'province_code' => '101300000',
            // 'psgc_code'=>'1001315000',
            // 'region_name'=>'Northern Mindanao (Region X)',
        ]);
    }
}






//municipal
// "code": "101315000",
// "name": "Maramag",
// "oldName": "",
// "isMunicipality": true,
// "provinceCode": "101300000",
// "regionCode": "100000000",
// "islandGroupCode": "mindanao",
// "psgc10DigitCode": "1001315000"
