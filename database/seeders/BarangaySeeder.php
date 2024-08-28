<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barangays;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barangays::create([
            'municipal_id'=>'1',
            'name' => 'Camp I',
            'phone' =>'0934834838',
            'email'=>'Barangayscamp@gmail.com'
            // 'old_name' => '',
            // 'code'=>'101315004',
            // 'province_code' =>'101300000',
            // 'municipal_code' => '101315000',
            // 'psgc_code'=>'1001315004',
            // 'region_code' => '100000000',
        ]);

        Barangays::create([
            'municipal_id'=>'1',
            'name' => 'North Poblacion',
            'phone' =>'0934834444',
            'email'=>'Barangaynorth@gmail.com'
            // 'old_name' => '',
            // 'code'=>'101315014',
            // 'province_code' =>'101300000',
            // 'municipal_code' => '101315000',
            // 'psgc_code'=>'1001315014',
            // 'region_code' => '100000000',
        ]);

        Barangays::create([
            'municipal_id'=>'1',
            'name' => 'South Poblacion',
            'phone' =>'0934834653',
            'email'=>'Barangaysouth@gmail.com'
            // 'old_name' => '',
            // 'code'=>'101315015',
            // 'province_code' =>'101300000',
            // 'municipal_code' => '101315000',
            // 'psgc_code'=>'1001315015',
            // 'region_code' => '100000000',
        ]);

    }
}




