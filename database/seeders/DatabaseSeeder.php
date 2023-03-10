<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Beverage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        // \App\Models\User::factory(1)->unverified()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(RoleSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(SeatSeeder::class);
        $this->call(BeverageTypeSeeder::class);
        Beverage::factory(3)->create();
    }
}
