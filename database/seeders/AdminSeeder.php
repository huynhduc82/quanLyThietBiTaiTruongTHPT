<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'phone_number' => '9999999999',
            'date_of_birth' => '01/01/0001',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
        ])->assignRole('SuperAdmin','','','');
    }
}
