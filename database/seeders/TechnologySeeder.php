<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = Technology::ORDERED_NAMES;

        foreach ($technologies as $tech) {
            Technology::firstOrCreate(['name' => $tech]);
        }
    }
}
