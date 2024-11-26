<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

//        User::factory()->withPersonalTeam()->create([
//            'username' => 'suadmin',
//            'first_name' => 'Super',
//            'last_name' => 'Admin',
//            'email' => 'suadmin@gmail.com',
//        ]);

        $this->call([
//            ProvinceSeeder::class,
//            ZipSeeder::class,
            StoreSeeder::class,
        ]);
    }
}
