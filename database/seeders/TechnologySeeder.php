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
        $technologies = [
            'Javascript',
            'Vue',
            'React',
            'Node.js',
            'Express',
            'EJS',
            'PHP',
            'Laravel',
            'MySQL',
            'Kotlin',
            'Java',
            'React Native',
            'WordPress'
        ];

        foreach ($technologies as $tech) {
            (new Technology(['name' => $tech]))->save();
        }
    }
}