<?php

namespace Database\Seeders;

use App\Models\Barangays;
use App\Models\Districts;
use App\Models\Reports;
use App\Models\Residents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (Barangays::all() as $barangay) {
            for ($i=1; $i<=100 ; $i++) {
                Reports::create([
                    'barangay_id'=>$barangay->id,
                    'name'=>fake()->unique()->name(),
                    'resident_name'=>fake()->name(),
                    'location'=>Districts::inRandomOrder()->value('name'),
                    'involved'=>fake()->name(),
                    'actions'=>fake()->paragraph(1),
                    'statements'=>fake()->paragraph(3),
                    'remark'=>fake()->randomElement([1,2,3]),
                    'date_reported'=>fake()->dateTimeBetween('-8 months','now'),
                    'date_incident'=>fake()->dateTimeBetween('-6 months','now'),
                    'date_recorded'=>fake()->dateTimeBetween('-6 months','now'),
                ]);
            }
        }
    }
}
