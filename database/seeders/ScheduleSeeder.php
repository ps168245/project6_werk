<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Generate schedules for each user
        Schedule::create([
            'startTime' => Carbon::parse('2023-05-23 10:00:00'),
            'endTime' => Carbon::parse('2023-05-23 10:30:00'),
            'location' => 'Kantoor locatie/gebouw',
            'description' => 'Test schedule task',
        ]);
        DB::table('schedule_user')->insert([
            'schedule_id' => '1',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Schedule::create([
            'startTime' => Carbon::parse('2023-05-23 10:00:00'),
            'endTime' => Carbon::parse('2023-05-23 10:30:00'),
            'location' => 'Kantoor locatie/gebouw',
            'description' => 'Test schedule task',
        ]);
        DB::table('schedule_user')->insert([
            'schedule_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Schedule::create([
            'startTime' => Carbon::parse('2023-05-23 10:00:00'),
            'endTime' => Carbon::parse('2023-05-23 10:30:00'),
            'location' => 'Kantoor locatie/gebouw',
            'description' => 'Test schedule task',
        ]);
        DB::table('schedule_user')->insert([
            'schedule_id' => '3',
            'user_id' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Schedule::create([
            'startTime' => Carbon::parse('2023-05-23 10:00:00'),
            'endTime' => Carbon::parse('2023-05-23 10:30:00'),
            'location' => 'Kantoor locatie/gebouw',
            'description' => 'Test schedule task',
        ]);
        DB::table('schedule_user')->insert([
            'schedule_id' => '4',
            'user_id' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
