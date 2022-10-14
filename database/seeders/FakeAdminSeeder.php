<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class FakeAdminSeeder extends Seeder
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
        for ($i=0; $i < 5; $i++) 
        {
            $user = new User;
            $user->name = $faker->name();
            $user->email =$faker->email();;
            $user->email_verified_at = now();
            $user->password = bcrypt('test');
            $user->tipe_pengguna = 1 ;
            $user->status_pengguna = 1;
            $user->save();
            
        }
    }
}
