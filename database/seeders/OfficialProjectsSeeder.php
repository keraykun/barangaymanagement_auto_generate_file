<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Districts;
use App\Models\Officials;
use App\Models\Projects;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class OfficialProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // foreach (Projects::all() as $project) {
        //     foreach (Officials::where('barangay_id',$project->barangay_id)->get() as $official) {
        //         $project->officials()->attach($official, ['barangay_id'=>$project->barangay_id,]);
        //     }
        // }


     }
}
