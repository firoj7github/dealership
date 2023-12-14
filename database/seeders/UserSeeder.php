<?php

namespace Database\Seeders;

use App\Enums\MembershipType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::insert([
            [
                'username' => "Admin",
                'email' => "admin@gmail.com",
                'adf_email' => null,
                'phone' => "(251)-123-1234",
                'role' => 1,
                'package' => null, // Set package to null
                'address' => null,
                'status' => 1,
                'is_verify_email' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make("password"),
                'remember_token' => Str::random(1),
            ],
            [
                'username' => "Dealer",
                'email' => "dealer@gmail.com",
                'adf_email' => 'mehediarif.du@gmail.com',
                'phone' => "(251)-321-4321",
                'role' => 2,
                'package' => 1,
                'address' => null,
                'status' => 1,
                'is_verify_email' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make("123456"),
                'remember_token' => Str::random(1),
            ],
            [
                'username' => "SKCO AUTOMOTIVE",
                'email' => "anthony201008@hotmail.com",
                'adf_email' => null,
                'phone' => "251-343-4488",
                'role' => 2,
                'package' => 3,
                'address' => null,
                'status' => 1,
                'is_verify_email' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make("Test@12345"),
                'remember_token' => Str::random(1),
            ],
            [
                'username' => "SKCO AUTOMOTIVE",
                'email' => "skabir@skcocorp.com",
                // 'adf_email' => "webleads@skcocorp.com",
                'adf_email' => "ofarid27@gmail.com",
                'phone' => "251-343-4488",
                'role' => 2,
                'package' => 4,
                'address' => '7410 Airport Blvd Mobile, AL 36608',
                'status' => 1,
                'is_verify_email' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make("Test@12345"),
                'remember_token' => Str::random(1),
            ],
            [
                'username' => "Buyer",
                'email' => "buyer@gmail.com",
                'adf_email' => null,
                'phone' => "(251)-132-4231",
                'role' => 0,
                'package' => 0,
                'address' => null,
                'status' => 1,
                'is_verify_email' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make("123456"),
                'remember_token' => Str::random(1),
            ],
        ]);

    }
}
//  Plutinum => 4, Blocked => 5