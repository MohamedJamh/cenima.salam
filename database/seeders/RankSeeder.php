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
            ['row_label' => 'A' ,'name' => 'classic', 'price' => 100.00],
            ['row_label' => 'B' ,'name' => 'classic', 'price' => 100.00],
            ['row_label' => 'C' ,'name' => 'classic', 'price' => 100.00],
            ['row_label' => 'D' ,'name' => 'premium', 'price' => 150.00],
            ['row_label' => 'E' ,'name' => 'premium', 'price' => 150.00],
        ];

        foreach ($ranks as $rank) {
            Rank::create($rank);
        }
    }
}
