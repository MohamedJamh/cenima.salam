<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Theater;
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
        User::factory(1)->unverified()->create();
        User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(RankSeeder::class);
        $this->call(SchemaSeeder::class);
        Theater::factory(3)->create();
        $this->call(BeverageTypeSeeder::class);
        Beverage::factory(3)->create();

        // $movie_ids = Movie::pluck('id');
        // User::factory(2)
        // ->create()
        // ->each(function ($user) use ($movie_ids){
        //     $user->movies()->attach($movie_ids->random(1));
        // });
    }
}
