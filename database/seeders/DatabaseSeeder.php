<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'role'=>'admin',
            'email' => 'test@example.com',
        ]);

        $this->call([
            AdminSecondarySeeder::class,
            ProvinceSeeder::class,
            MunicipalSeeder::class,
            BarangaySeeder::class,
            DistrictSeeder::class,
            CampOneOfficialsSeeder::class,
            PoblacionNorthOfficialsSeeder::class,
            PoblacionSouthOfficialsSeeder::class,
            ResidentsSeeder::class,
            PaymentSeeder::class,
            PositionsSeeder::class,
            OfficialsPositionsSeeder::class,
            ReportSeeder::class,
            RoleSeeder::class,
        ]);


        // $this->call([
        //     AdminSecondarySeeder::class,
        //     ProvinceSeeder::class,
        //     MunicipalSeeder::class,
        //     BarangaySeeder::class,
        //     DistrictSeeder::class,
        //     CampOneOfficialsSeeder::class,
        //     PoblacionNorthOfficialsSeeder::class,
        //     PoblacionSouthOfficialsSeeder::class,
        //     PositionsSeeder::class,
        //     OfficialsPositionsSeeder::class,
        //     LogosSeeder::class,
        //     ResidentsSeeder::class,
        //     PaymentSeeder::class,
        //     ReportSeeder::class
        // ]);





    //     $this->call([
    //        ProjectsSeeder::class,
    //        OfficialProjectsSeeder::class
    //     ]);

        /**********@ For Test Resident Count purpose @********/



    }
}

