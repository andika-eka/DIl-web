<?php

namespace Database\Seeders;

use App\Models\Sumatif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgressSeeder extends Seeder
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
            SubcpmkPengamBilanSeeder::class,
            FormatifSeeder::class,
            SumatifSeeder::class,
        ]);
    }
}
