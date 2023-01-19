<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call([
            FakeAdminSeeder::class,
            FakePengajarSeeder::class,
            FakeSiswaSeeder::class,
            MatkulWithKelasSeeder::class,
            KelasSettingSeeder::class,
            PengambilanKelasSeeder::class,
            ApplyKelasSeeder::class,
            PengampuanSeeder::class,
            SubCpmkSeeder::class,
            IndikatorSeeder::class,
            MateriSeeder::class,
            SubcpmkPengamBilanSeeder::class,
            SoalSeeder::class,
            JawabanSeeder::class,
            
        ]);
    }
}
