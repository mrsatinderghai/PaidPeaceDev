<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'id' => 1,
                'name' => 'Sharp Mower',
                'created_at' => Carbon::create(2017, 1, 3, 18, 39, 00),
                'updated_at' => Carbon::create(2017, 1, 29, 22, 17, 25),
                'logo' => 'img/team_logos/588ea93d6a926.jpg',
                'address1' => 'PO Box 153',
                'address2' => '',
                'city' => 'New Palestine',
                'state' => 'IN',
                'zip' => '46163',
                'phone' => '317-340-3637',
            ],
        ]);
    }
}
