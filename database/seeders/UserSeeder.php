<?php

namespace Database\Seeders;

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
        $provinsi = User::create([
            'name' => 'Bawaslu Provinsi',
            'username' => 'bawaslu-provinsi',
            'email' => 'provinsi@gmail.com',
            'password' => bcrypt('provinsi1234'),
        ]);
        $provinsi->assignRole('bawaslu-provinsi');

        $kota = User::create([
            'name' => 'Bawaslu Kota',
            'username' => 'bawaslu-kota',
            'email' => 'kota@gmail.com',
            'password' => bcrypt('kota1234'),
        ]);
        $kota->assignRole('bawaslu-kota');


        $panwascam = User::create([
            'name' => 'Panwascam',
            'username' => 'panwascam',
            'email' => 'panwascam@gmail.com',
            'password' => bcrypt('panwascam1234'),
        ]);
        $panwascam->assignRole('panwascam');
    }
}
