<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        // User::factory()->create([
        //     'username' => 'putri',
        //     'nama' => 'Putri Nurul Izza',
        //     'jabatan' => 'Magang',
        //     'bidang' => 'TIK',
        //     'password' => Hash::make('putri'),
        //     'is_admin' => 0,
        //     'remember_token' => Str::random(10),
        // ]);
    }
}
