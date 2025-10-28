<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $employee = [
            [
                'name' => 'Admin',
                'father_name' => 'Abdul',
                'last_name' => 'Nazari',
                'id_number' => 'ID3001',
                'designation' => 'super_admin',
                'phone' => '0779898878',
                'email' => 'admin@gmail.com',
                'image' => 'admin.png',
                'salary' => '71000',
                'status' => '1',
                'account_user_id' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]
            // Add more records as needed
        ];

        Employee::insert($employee);
    }
}
