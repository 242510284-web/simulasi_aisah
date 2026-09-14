<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; //
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $kasirRole = Role::where('name', 'kasir')->first();

        User::updateOrCreate(
    ['email' => 'aisah@gmail.com'], 
    [
        'name' => 'aisah', 
        'password' => Hash::make('password'),
        'role_id' => $adminRole?->id ?? 1,
    ]
);
        User::updateOrCreate(
            ['email' => 'kasir@gmail.com'],
            [
                'name' => 'Kasir',
                'password' => Hash::make('password'),
                'role_id' => $kasirRole?->id ?? 2,
            ]
        );
    }
}
