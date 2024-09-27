<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Database\Seeds\UserTableSeeder::class);
        $this->call(Database\Seeds\TeamsTableSeeder::class);
        $this->call(Database\Seeds\RolesTableSeeder::class);
        $this->call(Database\Seeds\ZipcodeareasTableSeeder::class);
    }
}
