<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\SubCpmk;
use App\Models\Indikator;

class IndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        $subCpmks = SubCpmk::all();
        foreach ($subCpmks as $subCpmk)
        {
            for($j=0; $j<rand(5,10); $j++)
            {
                $indikator = new Indikator();
                $indikator->id_subCpmk = $subCpmk->id_subCpmk;
                $indikator->nomorUrut_indikator = $j+1;
                $indikator->narasi_indikator = $faker->text(rand(150,300));
                $indikator->pertemuanKe =  rand(1,16);
                $indikator->level_indikator =rand(1,6);
                $indikator->save();
            }
            
        }
    }
}
