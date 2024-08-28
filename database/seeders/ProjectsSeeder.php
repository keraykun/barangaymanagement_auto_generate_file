<?php

namespace Database\Seeders;

use App\Models\Districts;
use App\Models\Projects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


    //    $this->faker = Faker::create();
    //    foreach (Districts::all() as $district) {
    //     Projects::create([
    //         'name'=>$this->faker->company(),
    //         'description'=>$this->faker->paragraph(),
    //         'barangay_id'=>$district['barangay_id'],
    //         'district'=>$district['name'],
    //         'zone'=>$district['zone'],
    //         'address'=>$district['address'],
    //         'start_date_at'=>$this->faker->dateTimeBetween('now', '+ 15 days'),
    //         'end_date_at'=>$this->faker->dateTimeBetween('+15 days', '+ 25 days'),
    //         'start_time_at'=> date('H:i:s'),
    //         'end_time_at'=>date('H:i:s'),
    //         'active'=>'Yes',
    //      ]);
    //    }
    }
}
