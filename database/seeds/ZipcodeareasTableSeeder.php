<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZipcodeareasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zipcodeareas')->insert([
            ['zip_code' => '46075', 'area' => 'NW'],
            ['zip_code' => '46077', 'area' => 'NW'],
            ['zip_code' => '46112', 'area' => 'NW'],
            ['zip_code' => '46167', 'area' => 'NW'],
            ['zip_code' => '46228', 'area' => 'NW'],
            ['zip_code' => '46254', 'area' => 'NW'],
            ['zip_code' => '46268', 'area' => 'NW'],
            ['zip_code' => '46278', 'area' => 'NW'],
            ['zip_code' => '46032', 'area' => 'N'],
            ['zip_code' => '46033', 'area' => 'N'],
            ['zip_code' => '46038', 'area' => 'N'],
            ['zip_code' => '46062', 'area' => 'N'],
            ['zip_code' => '46074', 'area' => 'N'],
            ['zip_code' => '46240', 'area' => 'N'],
            ['zip_code' => '46260', 'area' => 'N'],
            ['zip_code' => '46037', 'area' => 'NE'],
            ['zip_code' => '46040', 'area' => 'NE'],
            ['zip_code' => '46055', 'area' => 'NE'],
            ['zip_code' => '46060', 'area' => 'NE'],
            ['zip_code' => '46216', 'area' => 'NE'],
            ['zip_code' => '46220', 'area' => 'NE'],
            ['zip_code' => '46226', 'area' => 'NE'],
            ['zip_code' => '46235', 'area' => 'E'],
            ['zip_code' => '46236', 'area' => 'NE'],
            ['zip_code' => '46250', 'area' => 'NE'],
            ['zip_code' => '46256', 'area' => 'NE'],
            ['zip_code' => '46122', 'area' => 'W'],
            ['zip_code' => '46123', 'area' => 'W'],
            ['zip_code' => '46168', 'area' => 'W'],
            ['zip_code' => '46214', 'area' => 'W'],
            ['zip_code' => '46222', 'area' => 'W'],
            ['zip_code' => '46224', 'area' => 'W'],
            ['zip_code' => '46231', 'area' => 'W'],
            ['zip_code' => '46234', 'area' => 'W'],
            ['zip_code' => '46241', 'area' => 'W'],
            ['zip_code' => '46201', 'area' => 'C'],
            ['zip_code' => '46202', 'area' => 'C'],
            ['zip_code' => '46203', 'area' => 'C'],
            ['zip_code' => '46204', 'area' => 'C'],
            ['zip_code' => '46205', 'area' => 'C'],
            ['zip_code' => '46208', 'area' => 'C'],
            ['zip_code' => '46225', 'area' => 'C'],
            ['zip_code' => '46117', 'area' => 'E'],
            ['zip_code' => '46140', 'area' => 'E'],
            ['zip_code' => '46148', 'area' => 'E'],
            ['zip_code' => '46163', 'area' => 'E'],
            ['zip_code' => '46219', 'area' => 'E'],
            ['zip_code' => '46229', 'area' => 'E'],
            ['zip_code' => '46235', 'area' => 'E'],
            ['zip_code' => '46239', 'area' => 'E'],
            ['zip_code' => '46113', 'area' => 'SW'],
            ['zip_code' => '46158', 'area' => 'SW'],
            ['zip_code' => '46221', 'area' => 'SW'],
            ['zip_code' => '46107', 'area' => 'S'],
            ['zip_code' => '46142', 'area' => 'S'],
            ['zip_code' => '46143', 'area' => 'S'],
            ['zip_code' => '46184', 'area' => 'S'],
            ['zip_code' => '46217', 'area' => 'S'],
            ['zip_code' => '46227', 'area' => 'S'],
            ['zip_code' => '46237', 'area' => 'S'],
            ['zip_code' => '46126', 'area' => 'SE'],
            ['zip_code' => '46130', 'area' => 'SE'],
            ['zip_code' => '46176', 'area' => 'SE'],
            ['zip_code' => '46259', 'area' => 'SE'],
            ['zip_code' => '46280', 'area' => 'N'],
            ['zip_code' => '46161', 'area' => 'SE'],
            ['zip_code' => '46218', 'area' => 'E'],
            ['zip_code' => '46111', 'area' => 'SW'],
            ['zip_code' => '46151', 'area' => 'SW'],
        ]);
    }
}
