<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'status' => 'active',
                'type' => 'super_admin',
                'photo' => 'admin.png',
                'password' => Hash::make('123456'),
                'lang' => 'en',
                'created_by' => '1',
                'created_at' => Carbon::now()
            ]
        );
    }
}
