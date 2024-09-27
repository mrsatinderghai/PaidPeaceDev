<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseManager
{
    public function createDatabase($databaseName)
    {
        DB::statement("CREATE DATABASE {$databaseName}");
    }

    public function dropDatabase($databaseName)
    {
        DB::statement("DROP DATABASE IF EXISTS {$databaseName}");
    }
}
