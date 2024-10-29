<?php

use Illuminate\Database\Seeder;

class UploadDumpedData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = database_path('seeds/dump_data_only.sql');

        DB::unprepared(file_get_contents($sql));
    }
}
