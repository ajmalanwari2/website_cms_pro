<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $now = Carbon::now();

        $rows = [];

        for ($i = 0; $i < 20; $i++) {
            $rows[] = [
                'name'       => $faker->company . ' Depot',
                'address'    => $faker->streetAddress,
                'city'       => $faker->city,
                'state'      => $faker->stateAbbr,
                'zipcode'    => $faker->postcode,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('locations')->insert($rows);
    }
}
