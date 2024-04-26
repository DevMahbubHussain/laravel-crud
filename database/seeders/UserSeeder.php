<?php

namespace Database\Seeders;

use App\constants\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => Role::ADMIN
        ]);

        User::factory()->create([
            'name' => 'Seller',
            'email' => 'seller@gmail.com',
        ]);
    }
}