<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '0597842665',
            'password' => Hash::make(123456789),
        ]);
        // $admin->assignRole(Role::findById(1, 'admin')); // Assign the super_admin role to the created admin
    }
}
