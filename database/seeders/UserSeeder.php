<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@medical.id',
            'phone' => '081812813814',
            'gender' => 'male',
            'role' => 'ADMIN',
            'password' => Hash::make('admin'),
        ]);
    }
}
