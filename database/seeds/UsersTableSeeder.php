<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$KlV30RHscjiXwY.hQDXXY.LGwHM7A7qvMkGnFkHJB3Q56R3ky7zYm',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
