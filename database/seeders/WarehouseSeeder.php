<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
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
                'warehouse_name' => 'Gudang A',
                'warehouse_id' => 'GD_001_20230603',
                'registered_date' => '2023-06-03',
                'status' => 'active',
            ],
            [
                'warehouse_name' => 'Gudang B',
                'warehouse_id' => 'GD_002_20230604',
                'registered_date' => '2023-06-04',
                'status' => 'active',
            ],
            [
                'warehouse_name' => 'Gudang C',
                'warehouse_id' => 'GD_001_20230601',
                'registered_date' => '2023-06-01',
                'status' => 'full',
            ],
        ];
        DB::table('warehouse')->insert($data);
    }
}
