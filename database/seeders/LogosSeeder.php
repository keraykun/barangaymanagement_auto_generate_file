<?php

namespace Database\Seeders;

use App\Models\Barangays;
use App\Models\Logos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class LogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //    $this->faker = Faker::create();
    //    foreach (Barangays::whereNotIn('id',['1'])->get() as $barangay) {
    //         Logos::create([
    //             'barangay_id'=>$barangay->id,
    //             'title'=>$barangay->name,
    //         ]);
    //    }
    //    $barangay = Barangays::whereIn('id',['1'])->first();
    //    Logos::create([
    //         'name'=>'logo.png',
    //         'barangay_id'=>$barangay->id,
    //         'title'=>$barangay->name,
    //     ]);
    }
}
