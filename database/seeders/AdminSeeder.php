<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Iqbal',
            'email' => 'iqbalabdulmajid02@gmail.com', // Ganti dengan email Anda
            'password' => Hash::make('AkuIqbal'), // Ganti dengan password aman
        ]);
    }
}
