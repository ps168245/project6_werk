<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Ajda Ozmen',
            'dateOfBirth' => Carbon::parse('2000-01-01'),
            'email' => 'Ajda.Ozmen@GV.nl',
            'password' => bcrypt('GroeneVingers123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //Bas
        DB::table('users')->insert([
            'id' => '2',
            'name' => 'Bas',
            'dateOfBirth' => Carbon::parse('2001-05-23'),
            'email' => 'bas@bas.nl',
            'password' => bcrypt('bas'),
            'created_at' => Carbon::parse('2023-05-23'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //Mike
        DB::table('users')->insert([
            'id' => '3',
            'name' => 'Mike',
            'dateOfBirth' => Carbon::parse('1998-08-28'),
            'email' => 'mike@mike.nl',
            'password' => bcrypt('mike'),
            'created_at' => Carbon::parse('2023-08-28'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '3',
            'role_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //Ryan
        DB::table('users')->insert([
            'id' => '4',
            'name' => 'Ryan',
            'dateOfBirth' => Carbon::parse('1998-05-08'),
            'email' => 'Ryan@ryan.nl',
            'password' => bcrypt('ryan'),
            'created_at' => Carbon::parse('2023-05-08'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '4',
            'role_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //Kyrill
        DB::table('users')->insert([
            'id' => '5',
            'name' => 'Kyrill',
            'dateOfBirth' => Carbon::parse('1998-06-10'),
            'email' => 'Kyrill@Kyrill.nl',
            'password' => bcrypt('kyrill'),
            'created_at' => Carbon::parse('2023-06-10'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '5',
            'role_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //TestKlant
        DB::table('users')->insert([
            'id' => '6',
            'name' => 'TestKlant',
            'dateOfBirth' => Carbon::parse('1999-02-05'),
            'email' => 'test@klant.nl',
            'password' => bcrypt('testklant'),
            'created_at' => Carbon::parse('2023-02-05'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '6',
            'role_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //TestPersoneelMedewerker
        DB::table('users')->insert([
            'id' => '7',
            'name' => 'TestPersoneelMedewerker',
            'dateOfBirth' => Carbon::parse('1999-02-05'),
            'email' => 'pm@pm.nl',
            'password' => bcrypt('TestPersoneelMedewerker'),
            'created_at' => Carbon::parse('2023-02-05'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '7',
            'role_id' => '6',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //TestMedewerker
        DB::table('users')->insert([
            'id' => '8',
            'name' => 'TestMedewerker',
            'dateOfBirth' => Carbon::parse('1999-02-05'),
            'email' => 'TestMedewerker@TestMedewerker.nl',
            'password' => bcrypt('TestMedewerker'),
            'created_at' => Carbon::parse('2023-02-05'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '8',
            'role_id' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //TestKassière
        DB::table('users')->insert([
            'id' => '9',
            'name' => 'TestKassière',
            'dateOfBirth' => Carbon::parse('1999-02-05'),
            'email' => 'TestKassière@TestKassière.nl',
            'password' => bcrypt('TestKassière'),
            'created_at' => Carbon::parse('2023-02-05'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '9',
            'role_id' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //TestManager
        DB::table('users')->insert([
            'id' => '10',
            'name' => 'TestManager',
            'dateOfBirth' => Carbon::parse('1999-02-05'),
            'email' => 'TestManager@TestManager.nl',
            'password' => bcrypt('TestManager'),
            'created_at' => Carbon::parse('2023-02-05'),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '10',
            'role_id' => '5',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
