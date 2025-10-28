<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('profile')->insert([
            'name'       => 'Logistics Ltd.',
            'email'      => 'info@omda-logistics.test',
            'phone'      => '+93-700-000000',
            'dot_number'  => '123456',
            'mc_number'   => '654321',
            'ein'        => '12-3456789',
            'scac'      => 'OMDA',
            'facebook'   => 'https://facebook.com/omda.logistics',
            'linkedin'   => 'https://linkedin.com/company/omda-logistics',
            'image'      => null, // or path like 'company/logo.png'
            'address'    => 'Street 123, Kabul, Afghanistan',
            'created_by' => 1,
            'created_at' => $now,
        ]);
    }
}
