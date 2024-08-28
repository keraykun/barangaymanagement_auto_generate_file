<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create([
            'name'=>'dashboard',
        ]);
        Roles::create([
            'name'=>'file',
        ]);
        Roles::create([
            'name'=>'official',
        ]);
        Roles::create([
            'name'=>'blotter',
        ]);
        Roles::create([
            'name'=>'resident',
        ]);
        Roles::create([
            'name'=>'purok',
        ]);
        Roles::create([
            'name'=>'staff',
        ]);
        Roles::create([
            'name'=>'certificate',
        ]);
        Roles::create([
            'name'=>'monthly',
        ]);
    }
}
