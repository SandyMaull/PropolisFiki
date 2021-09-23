<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Data;
use Illuminate\Contracts\Container\BindingResolutionException;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') != 'production') {

            $faker = Faker::create('id_ID');
            for($i = 0; $i <= 5000; $i++){
                $name = $faker->name;
                // User::create([
                //     'username' => strtolower(preg_replace('/\s+/', '', preg_replace('~[^A-Za-z0-9]~','', $name))),
                //     'name' => $name,
                //     'email' => Str::random(5) . '@gmail.com',
                //     'tgl_lahir' => Carbon::now()->subMinutes(rand(1, 55)),
                //     'avatar' => Str::random(10). '.jpg',
                //     'password' => app('hash')->make('password'),
                //     'email_verified_at' => Carbon::now()
                // ]);
                Data::create([
                    'nama' => $name,
                    'no_telp' => '08' . rand(0000000000,9999999999),
                    'position' => $faker->randomElement(['Distributor' ,'Agent', 'Reseller', 'CT', 'Other']),
                    'superior' => 0
                ]);
            }
        } else {
            throw new BindingResolutionException("Application is in production launching! Seeding is disabled.");
        }
    }
}
