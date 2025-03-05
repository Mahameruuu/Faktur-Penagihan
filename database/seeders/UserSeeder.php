<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Mahameru',
                'email' => 'mahameru@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin', // Tambahkan role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supervisor Satu',
                'email' => 'supervisor1@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'supervisor', // Role supervisor
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
