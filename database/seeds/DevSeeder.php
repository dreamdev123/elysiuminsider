<?php

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Event::fake();

        $sql = database_path('seeds/dev/jobs.sql');

        DB::unprepared(file_get_contents($sql));
    }
}
