<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Beverage;
use App\Models\Movie;
use App\Models\User;
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
        // \App\Models\User::factory(1)->unverified()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // $this->call(RoleSeeder::class);
        // $this->call(RankSeeder::class);
        // $this->call(SeatSeeder::class);
        // $this->call(BeverageTypeSeeder::class);
        // Beverage::factory(3)->create();
        $this->call(MovieSeeder::class);

        // $movie_ids = Movie::pluck('id');
        // User::factory(2)
        // ->create()
        // ->each(function ($user) use ($movie_ids){
        //     $user->movies()->attach($movie_ids->random(1));
        //     $user->roles()->attach([2]);
        // });
    }
}
