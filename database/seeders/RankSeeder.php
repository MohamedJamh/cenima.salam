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
            ['name' => 'Normal' , 'price' => 100.00],
            ['name' => 'Classic' , 'price' => 150.00],
            ['name' => 'Premium' , 'price' => 300.00]
        ];

        foreach ($ranks as $rank) {
            Rank::create($rank);
        }
    }
}
