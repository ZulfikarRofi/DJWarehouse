<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
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
                'name' => 'Zigma',
                'product_number' => 'krmk_001',
                'type' => 'Glossy',
                'quality' => 'kwi',
                'image' => '',
                'colors' => 'Grey',
                'merk' => 'Asia',
                'size' => '30 x 30',
                'class' => '',
                'sell_price' => '47000',
                'buy_price' => '35000',
            ],
            [
                'name' => 'Corsica',
                'product_number' => 'krmk_002',
                'type' => 'Glossy',
                'quality' => 'kwi',
                'image' => '',
                'colors' => 'Red',
                'merk' => 'Asia',
                'size' => '30 x 30',
                'class' => '',
                'sell_price' => '55000',
                'buy_price' => '45000',
            ],
            [
                'name' => 'Murano',
                'product_number' => 'krmk_003',
                'type' => 'Glossy',
                'quality' => 'kwi',
                'image' => '',
                'colors' => 'White',
                'merk' => 'Asia',
                'size' => '30 x 30',
                'class' => '',
                'sell_price' => '43000',
                'buy_price' => '33000',
            ],
            [
                'name' => 'Oscar',
                'product_number' => 'krmk_004',
                'type' => 'Glossy',
                'quality' => 'kwi',
                'image' => '',
                'colors' => 'Black',
                'merk' => 'Asia',
                'size' => '30 x 30',
                'class' => '',
                'sell_price' => '40000',
                'buy_price' => '30000',
            ],
            [
                'name' => 'Oscar',
                'product_number' => 'krmk_005',
                'type' => 'Matt',
                'quality' => 'kwi',
                'image' => '',
                'colors' => 'Dark Brown',
                'merk' => 'Asia',
                'size' => '30 x 30',
                'class' => '',
                'sell_price' => '65000',
                'buy_price' => '55000',
            ],
        ];

        DB::table('product')->insert($data);
    }
}
