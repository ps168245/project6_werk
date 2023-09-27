<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            'id' => '1',
            'name' => 'Bibi de Boer',
            'address' => 'Groen van Prinstererlaan',
            'housenumber' => '2',
            'postcode' => '5142VB',
            'region' => 'Waalwijk',
            'province' => 'Noord-Brabant',
            'country' => 'Nederland',
            'phonenumber' => '0416330010',
            'instructions' => 'Verstop de pakketjes in de blauwe kliko, mocht er niemand thuis zijn.',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('addresses')->insert([
            'id' => '2',
            'name' => 'Fatima Brandt',
            'address' => 'Lindengracht',
            'housenumber' => '11b',
            'postcode' => '1015KB',
            'region' => 'Amsterdam',
            'province' => 'Noord holland',
            'country' => 'Nederland',
            'phonenumber' => '0207009456',
            'instructions' => '',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('addresses')->insert([
            'id' => '3',
            'name' => 'Bas',
            'address' => 'idk',
            'housenumber' => '69',
            'postcode' => '6666AA',
            'region' => 'Groningen',
            'province' => 'Groningen',
            'country' => 'Nederland',
            'phonenumber' => '',
            'instructions' => '',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
