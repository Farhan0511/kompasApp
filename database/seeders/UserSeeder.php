<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Penanggung Jawab
        User::create([
            'name' => 'Penanggung Jawab',
            'email' => 'pj@kompasapp.test',
            'password' => Hash::make('password'),
            'role' => 'penanggung_jawab',
            'nim' => null,
        ]);

        // Ketua
        User::create([
            'name' => 'Ketua',
            'email' => 'ketua@kompasapp.test',
            'password' => Hash::make('password'),
            'role' => 'ketua',
            'nim' => null,
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Mahasiswa Demo',
            'email' => 'mhs@kompasapp.test',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '12345678',
        ]);
    }
}
