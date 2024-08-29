<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => 'Admin',
                'created_at' => Carbon::create(2017, 1, 3, 18, 45, 57),
                'updated_at' => Carbon::create(2017, 1, 3, 18, 45, 57),
            ],
            [
                'id' => '2',
                'name' => 'User',
                'created_at' => Carbon::create(2017, 1, 3, 18, 46, 57),
                'updated_at' => Carbon::create(2017, 1, 3, 18, 46, 57),
            ],
        ]);
    }
}
