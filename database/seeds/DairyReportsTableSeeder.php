<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DairyReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dairyreports')->truncate();
        for ($i = 1; $i < 100; $i++){
            DB::table('dairyreports')->insert([
                [
                    'title' => 'test',
                    'user_id' => 1,
                    'content' => 'TEST',
                    'reporting_time' => Carbon::create(2018, 2, 5),
    
                ],
            ]);
        }

    }
}
