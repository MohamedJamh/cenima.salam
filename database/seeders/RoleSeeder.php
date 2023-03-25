<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
        ]);
        $admin->syncPermissions([
            'show movies',
            'add movies',
            'delete movies',

            'show beverages',
            'add beverages',
            'edit beverages',
            'delete beverages',

            'show theaters',
            'add theaters',
            'edit theaters',
            'delete theaters',

            'show showtimes',
            'add showtimes',
            'edit showtimes',
            'delete showtimes',

            'show all tickets',
        ]);
        $client = Role::create([
            'name' => 'client',
        ]);
        $client->syncPermissions([
            'show movies',
            'add favorit movie',
            'delete favorit movie',

            'show beverages',
            'order beverages',

            'show theaters',

            'show showtimes',

            'show reserved tickets',
            'cancel tickets'
        ]);
    }
}
