<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//12 Import Hash Facades
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        //11 Seeder Admin
        user::create(
            [
                'id' => 0,
                'id_sekolah' => 0,
                'nama' => 'AdminPerpus',
                'kelas' => '',
                'jurusan' => '',
                'username' => 'AdminPerpus',
                'role' => 'admin',
                'password' => Hash::make('AdminPerpus123'),
                'email' => 'perpus@smktelkom-jkt.sch.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
