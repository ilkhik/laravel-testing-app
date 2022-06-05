<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__ . '/../../sql/import.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }

}
