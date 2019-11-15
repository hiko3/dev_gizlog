<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DailyReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dailyreports')->truncate();
            DB::table('dailyreports')->insert([
                [
                    'title' => 'test',
                    'user_id' => 1,
                    'content' => 'TEST',
                    'reporting_time' => Carbon::create(2018, 2, 5),
    
                ],
            ]);

    }
}
