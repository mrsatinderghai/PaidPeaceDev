<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Ben Parker',
                'email' => 'bendparker@gmail.com',
                'password' => '$2y$10$nbx.y2M3ZLhDJGuu0ZS9.O2zfV9hmea4RrCoj3gpU3nY47XWQRYva', // Already hashed password
                'team_id' => 1,
                'is_admin' => 1,
                'is_active' => 1,
                'remember_token' => 'DDyM9yUOsYgykERJVhswg2IfOVNlh3bFDZJg9OAB0MNbj4PGZof64rNiOeAw',
                'created_at' => '2017-01-03 18:37:19',
                'updated_at' => '2024-08-09 18:59:16',
            ]
        ]);
    }
}
