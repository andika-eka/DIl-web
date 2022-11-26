<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Materi;
use App\Models\Indikator;
class MateriSeeder extends Seeder
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
        $indikators = Indikator::all();
        foreach ($indikators as $indikator)
        {
            for($j=0; $j<rand(1,3); $j++)
            {
                $materi = new Materi();
                $materi->id_indikator = $indikator->id_indikator;
                $materi->nomorUrut_materi = $j+1;
                $materi->nama_materi = $faker->bs() ;
                $materi->pathFile_materi = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
                $materi->save();
            }
            
        }

    }
}
