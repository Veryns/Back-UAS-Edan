<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@solo.com'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@solo.com',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}