<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Employee::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        Employee::create([
            'name' => 'Ivan Castro',
            'email' => 'cipcastro123@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'employee',
        ]);

        Employee::create([
            'name' => 'Joshua Embestro',
            'email' => 'joshuaembestro12345@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'employee',
        ]);

        Employee::create([
            'name' => 'Jarred Reyes',
            'email' => 'bli8tzgt@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'employee',
        ]);
    }
}
