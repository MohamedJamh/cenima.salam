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
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            RankSeeder::class,
            SchemaSeeder::class,
            BeverageTypeSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            GenreSeeder::class,
            MovieSeeder::class
        ]);
        Theater::factory(3)->create();
        Beverage::factory(3)->create();

        User::factory(1)->unverified()->create()->each(function($user){
            $user->assignRole('client');
        });
        User::factory(1)->create()->each(function($user){
            $user->assignRole('client');
        });

        // User::factory(2)
        // ->create()
        // ->each(function ($user) use ($movie_ids){
        //     $user->movies()->attach($movie_ids->random(1));
        // });
    }
}
