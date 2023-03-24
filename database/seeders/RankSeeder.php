<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ranks = [
            ['row_label' => 'ABC' ,'name' => 'classic', 'price' => 100.00],
            ['row_label' => 'DEF' ,'name' => 'premium', 'price' => 150.00],
        ];

        foreach ($ranks as $rank) {
            Rank::create($rank);
        }
    }
}
