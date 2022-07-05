<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid'     => 1234,
            'first_name' => 'admin',
            'last_name' => 'awammer',
            'email'     => 'aait@info.com',
            'phone'     => '0555105813',
            'password'  => 123456,
            'user_type' => 1,
            'role_id'   => 1,
            'active' => '1',
        ]);
    }
}
