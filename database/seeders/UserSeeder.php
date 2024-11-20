<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ])->assignRole($adminRole);
    
        User::create([
            'name' => 'User',
            'email' => 'engsofiangamal@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $this->command->info('Admin and regular user created successfully!');

    }
}
