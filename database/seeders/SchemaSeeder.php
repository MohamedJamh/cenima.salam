<?php

namespace Database\Seeders;

use App\Models\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schemas = [
            [
                'name' => 'A',
                'layout_break' => '6,7,18,19',
                'capacity' => 120,
                'per_line' => 24
            ],
            [
                'name' => 'B',
                'layout_break' => '6,7,13,14',
                'capacity' => 90,
                'per_line' => 19
            ],
            [
                'name' => 'C',
                'layout_break' => '6,7',
                'capacity' => 60,
                'per_line' => 12
            ]
        ];
        foreach ($schemas as $schema) {
            Schema::create($schema);
        }
    }
}
