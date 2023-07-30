<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnersSeeder extends Seeder
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
                'partners_name' => 'PT. Adi Jaya',
                'partners_ID' => 'SP_001',
                'address' => 'Mojokerto',
                'type' => 'supplier',
                'phone_number' => '0855648853152',
            ],
            [
                'partners_name' => 'PT. Sumber Rejeki',
                'partners_ID' => 'SP_002',
                'address' => 'Bandung',
                'type' => 'supplier',
                'phone_number' => '08122564859302',
            ],
            [
                'partners_name' => 'PT. Naga Mas',
                'partners_ID' => 'SP_003',
                'address' => 'Gresik',
                'type' => 'supplier',
                'phone_number' => '084585641523',
            ],
        ];

        DB::table('partners')->insert($data);
    }
}
