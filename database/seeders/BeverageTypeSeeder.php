<?php

namespace Database\Seeders;

use App\Models\BeverageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeverageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $beverage_types = ['Soda','Popcorn','Snacks','Combo'];
        foreach($beverage_types as $type){
            BeverageType::create([
                'name' => $type
            ]);
        }
    }
}
