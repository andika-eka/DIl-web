<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Siswa;

class FakeSiswaSeeder extends Seeder
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
        for ($i=0; $i < 400; $i++) 
        {
            $user = new User;
            $user->name = $faker->name();
            $user->email =$faker->email();;
            $user->email_verified_at = now();
            $user->password = bcrypt('test');
            $user->tipe_pengguna = 3 ;
            $user->status_pengguna = 1;
            $user->save();
            
            $siswa  = new Siswa;
            
            $siswa->id_siswa = $user->id;
            $siswa->email_siswa = $user->email;
            $siswa->identitas_siswa    = $faker->asciify('***************');
            $siswa->nama_siswa         = $user->name;
            $siswa->jenisKelamin_siswa = $faker->numberBetween(1,2);
            $siswa->tanggalLahir_siswa = $faker->date();
            $siswa->account_active        = true;
            $siswa->save();
            
        }
    }
}
