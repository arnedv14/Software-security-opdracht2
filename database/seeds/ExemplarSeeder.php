<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class ExemplarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 1,
            'is_loaned' => 0,
            'remarks' => ''
        ]);

        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 2,
            'is_loaned' => 0,
            'remarks' => ''
        ]);
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 1,
            'is_loaned' => 0,
            'remarks' => ''
        ]);
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 2,
            'is_loaned' => 0,
            'remarks' => ''
        ]);
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 3,
            'is_loaned' => 0,
            'remarks' => ''
        ]);
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 3,
            'is_loaned' => 0,
            'remarks' => ''
        ]);
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 3,
            'is_loaned' => 0,
            'remarks' => ''
        ]);
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 4,
            'is_loaned' => 0,
            'remarks' => ''
        ]);
        DB::table('exemplars')->insert([
            'GUID' => Uuid::generate(),
            'itemID' => 4,
            'is_loaned' => 0,
            'remarks' => 'Be careful with this exemplar, as it is fragile'
        ]);
    }
}
