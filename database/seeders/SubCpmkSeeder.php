<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\SubCpmk;
use App\Models\MataKuliah;

class SubCpmkSeeder extends Seeder
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
        $matkuls = MataKuliah::all();
        foreach ($matkuls as $matkul)
        {
            for($j=0; $j<rand(1,8); $j++)
            {
                $subCpmk = new SubCpmk;
                $subCpmk->id_mataKuliah = $matkul->id_matakuliah;
                $subCpmk->nomorUrut_subCpmk = $j+1;
                $subCpmk->narasi_subCpmk = $faker->text(rand(150,300));
                $subCpmk->pathFile_materiTeks ="D:\\PHP\\DIL\\public\\files\\1668355102.pdf";
                $subCpmk->save();
            }
            
        }
    }
}
