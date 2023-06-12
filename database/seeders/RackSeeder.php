<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'A-1',
                'location' => 'front',
                'rack_id' => 'AA-0001-20230603',
                'category' => 'A',
                'registered_date' => '2023-06-03',
                'capacity' => '10',
            ],
            [
                'name' => 'B-1',
                'location' => 'middle',
                'rack_id' => 'BB-0002-20230603',
                'category' => 'B',
                'registered_date' => '2023-06-03',
                'capacity' => '7',
            ],
            [
                'name' => 'C-1',
                'location' => 'back',
                'rack_id' => 'CC-0003-20230603',
                'category' => 'C',
                'registered_date' => '2023-06-03',
                'capacity' => '10',
            ],
        ];

        DB::table('rack')->insert($data);
    }
}
