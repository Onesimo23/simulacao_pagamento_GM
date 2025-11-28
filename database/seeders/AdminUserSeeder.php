<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'onesimonuvunga@gmail.com';
        $phone = '834621024';
        $password = '12345678';

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'José Onésimo Abel Nuvunga',
                'phone' => $phone,
                'role' => 'admin',
                'password' => Hash::make($password),
            ]
        );
    }
}
