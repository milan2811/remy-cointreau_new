<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Role::truncate();        

        Role::create([
            'role_name' => 'Froztech Admin',
            'role' => 1,
        ]);

        Role::create([
            'role_name' => 'Super Admin',
            'role' => 2,
        ]);

        Role::create([
            'role_name' => 'Bar Admin',
            'role' => 3,
        ]);
        
    }
}
