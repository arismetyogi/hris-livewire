<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('/data/provinces.json');

        // Check if the JSON file exists
        if (File::exists($jsonPath)) {
            // Read the file
            if (File::exists($jsonPath)) {
                $jsonData = File::get($jsonPath);
                $provinces = json_decode($jsonData, true);

                if (is_array($provinces)) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //for dev only -> inject data
                    DB::table('provinces')->insert($provinces);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //for dev only -> inject data
                }
            } else {
                $this->command->error("JSON file not found at {$jsonPath}");
            }
        }
    }
}
