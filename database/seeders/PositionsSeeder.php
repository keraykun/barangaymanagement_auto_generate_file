<?php

namespace Database\Seeders;


use App\Models\Positions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Positions::create([
            'name' => 'Counselor',
            'rank'=>1,
            'unique'=>1,
        ]);
        Positions::create([
            'name' => 'Kapitan',
            'rank'=>2,
            'unique'=>1,
        ]);
        Positions::create([
            'name' => 'Kagawad',
            'rank'=>3,
            'unique'=>0,
        ]);
        Positions::create([
            'name' => 'Treasurer',
            'rank'=>4,
            'unique'=>1,
        ]);
        Positions::create([
            'name' => 'Secretary',
            'rank'=>5,
            'unique'=>1,
        ]);
    }
}
