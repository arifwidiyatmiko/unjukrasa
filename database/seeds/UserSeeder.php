<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // $asdep = Asdep::all()->pluck('id')->toArray();
        User::create(array(
            'name' => 'Arif Widiyatmiko',
            'email' => 'arifwidiyatmiko@ai.astra.co.id',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => bcrypt('Friday1407!'),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => true,
            // 'id_asdep' => $faker->randomElement($asdep),
        ));
    }
}
