<?php

use Illuminate\Database\Seeder;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'first_name' => 'Mr.',
            'last_name' => 'Super Admin',
            'email' => 'superadmin@email.com',
            'subscriber_id' => null,
            'user_name' => null,
            'phone' => null,
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'role' => SUPER_ADMIN_ROLE,
            'email_verification_code' => null,
            'status' => USER_ACTIVE_STATUS
        ]);
    }
}
