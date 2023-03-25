<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // movies
        Permission::create(['name' => 'show movies']);
        Permission::create(['name' => 'add movies']);
        Permission::create(['name' => 'delete movies']);
        //movies favorit list
        Permission::create(['name' => 'add favorit movie']);
        Permission::create(['name' => 'delete favorit movie']);
        //beverage
        Permission::create(['name' => 'show beverages']);
        Permission::create(['name' => 'add beverages']);
        Permission::create(['name' => 'edit beverages']);
        Permission::create(['name' => 'delete beverages']);
        Permission::create(['name' => 'order beverages']);
        //theaters
        Permission::create(['name' => 'show theaters']);
        Permission::create(['name' => 'add theaters']);
        Permission::create(['name' => 'edit theaters']);
        Permission::create(['name' => 'delete theaters']);
        //showtimes
        Permission::create(['name' => 'show showtimes']);
        Permission::create(['name' => 'add showtimes']);
        Permission::create(['name' => 'edit showtimes']);
        Permission::create(['name' => 'delete showtimes']);
        //tickets
        Permission::create(['name' => 'show all tickets']);
        Permission::create(['name' => 'show reserved tickets']);
        Permission::create(['name' => 'book tickets']);
        Permission::create(['name' => 'cancel tickets']);



    }
}
