<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeed extends Seeder
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
                'game_id' => 1,
                'currency_id' => 1,
                'price' => 5495,
                'discount_percent' => 0,
                'final_price' => 5495,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'game_id' => 1,
                'currency_id' => 2,
                'price' => 10500,
                'discount_percent' => 0,
                'final_price' => 10500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        DB::table('prices')->insert($data);
    }
}
