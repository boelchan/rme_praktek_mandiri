<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
        ]);
        User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('123'),
        ]);
        Patient::create([
            'uuid'=> 'uuid',
            'nik' => '1111111111111111',
            'no_rm' => '12345',
            'full_name' => 'bulyan',
            'gender' => 'L',
            'dob'=> '2000-01-01',
            'address' => 'sumenep'
        ]);
    }
}
